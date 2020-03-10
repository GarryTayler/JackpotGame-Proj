<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Chats_Model');
	}
	public function login()
	{
		if( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
			redirect($_SESSION['url']);
		}
		else
			$this->load_view('user/login');
    }
	public function register()
	{
		$this->load_view('user/register');
	}
	public function signIn()
	{
		$info = $this->input->post();
		$ret = array();
		$result = $this->Users_Model->getUserInfobyUsername($info['username']);
		if(count($result) < 1) {
			$result = $this->Users_Model->getUserInfobyEmail($info['username']);
			if(count($result) < 1) {
				$ret['error_code'] = 1;
				$ret['res_msg'] = 'Incorrect username/email and / or password. Do you need help loggin in?';
				echo json_encode($ret);
				return;
			}
		}
		if( $result[0]['PASSWORD'] != md5($info['password']) ) {
			$ret['error_code'] = 1;
			$ret['res_msg'] = 'Incorrect username/email and / or password. Do you need help loggin in?';
			echo json_encode($ret);
			return;
		}
		else if( $result[0]['PASSWORD'] == md5($info['password']) && $result[0]['STATE'] != '0' ) {
			$ret['error_code'] = 1;
			$ret['res_msg'] = 'You are not allowed to use this account. Do you need support?';
			echo json_encode($ret);
			return;
		}
		$session_userdata = array(
			'WALLET' => $result[0]['WALLET'],
			'USERNAME'  => $result[0]['USERNAME'],
			'EMAIL'  => $result[0]['EMAIL'],
			'AVATAR' => $result[0]['AVATAR'],
			'logged_in' => TRUE,
			'USERID' => $result[0]['ID']
		);
		$this->session->set_userdata($session_userdata);
		$this->session->set_userdata('token', $this->Users_Model->saveToken($this->input->ip_address() , $this->session->userdata('USERID')));
		$ret['error_code'] = 0;
		if( isset($_SESSION['url']) && ($_SESSION['url'] != '') ) {
			$ret['login_link'] = $this->session->userdata('url');
		}
		else
			$ret['login_link'] = site_url('');
		echo json_encode($ret);
		return;
	}

    public function signUp() {
        $info = $this->input->post();
        $ret = array();
        $result = $this->Users_Model->getUserInfobyEmail($info['email']);
        if(count($result) > 0) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your email address is used already. Please type other email.';
            echo json_encode($ret);
            return;
        }

        $code = $this->Users_Model->saveUserInfo($info);
        if($code == false) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your account infomation is not correct. Please check again.';
            echo json_encode($ret);
            return;
        }
        $ret['error_code'] = 0;
        if( isset($_SESSION['url']) && ($_SESSION['url'] != '') ) {
            $ret['link'] = $this->session->userdata('url');
        }else {
            $ret['link'] = site_url('');
        }
        echo json_encode($ret);
    }

    public function my_wallet() {
	    $userId = $this->session->userdata('USERID');
	    $balance = $this->Users_Model->available_wallet($userId);
	    echo json_encode(array('status'=>1, 'wallet'=>number_format($balance,0 , '.' , ' ')));
    }
	public function logout() 
	{
		$unset_userdata = array(
			'WALLET' => 0,
			'USERNAME'  => '',
			'EMAIL'  => '',
			'AVATAR' => '',
			'logged_in' => FALSE
		);

		session_destroy();

		$this->session->unset_userdata($unset_userdata);
		redirect();
	}

	public function getChatList() 
	{
		$type = $this->input->post();
		$result = $this->Chats_Model->getChatList($type['type']);
		$ret_data = array();
		$ret_data['error_code'] = 0;
		$ret_data['result'] = $result;
		echo json_encode($ret_data);
	}

	public function get_balance () 
	{
		if( !isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] != TRUE) ){
			echo json_encode( array('HTTP_CODE' => HTTP_NOT_ATHENTICATED , 'res_msg' => 'Log in to get access to all features.') );
			return;
		}	
		$userInfo = $this->Users_Model->getUserInfobyUserid($_SESSION['USERID']);
		echo json_encode( array('HTTP_CODE' => HTTP_OK , 'WALLET' => $userInfo['WALLET']) );
		return;
	}

	public function emit() 
	{
		if( !isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] != TRUE) ){
			echo json_encode( array('error_code' => 1 , 'res_msg' => 'Log in to get access to all features.') );
			return;
		}		
		$host = CHAT_SERVER_URL."post_msg";
		$curtime = time();
		$param_data = array();
		$param_data['msg'] = $_POST['msg'];
		$param_data['avatar'] = $this->session->userdata('AVATAR');
		$param_data['username'] = $this->session->userdata('USERNAME');
		$param_data['curtime'] = $curtime;
		$param_data['type'] = $_POST['type'];

		$json = json_encode($param_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(    //<--- Added this code block
		        'Content-Type: application/json',
		        'Content-Length: ' . strlen($json))
		);

		$data = curl_exec($ch);
		$ret = json_decode($data , true);
		//error_code
		if($ret['error_code'] == 0) {
			$insert_data = array(
				'CHAT_TYPE' => $_POST['type'] ,
				'CREATE_TIME' => $curtime ,
				'UPDATE_TIME' => $curtime ,
				'MSG' => $_POST['msg'],
				'IPADDRESS' => $this->input->ip_address(),
				'USERID' => $this->session->userdata('USERID')
			);

			$this->db->insert('chats' , $insert_data);
			echo json_encode( array('error_code' => 0) );
		}
		else {
			echo json_encode( array('error_code' => 1) );	
		}
	}

}
