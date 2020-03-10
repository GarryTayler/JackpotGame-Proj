<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if( !(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
			redirect('Login');
			return;
		}
        $this->load->model('Users_Model');
	}
	public function index() {
		$contentData = array();
		$userId = $this->session->userdata('USERID');
		$userInfo = $this->Users_Model->getUserInfobyUserid($userId);
		$contentData['userInfo'] = $userInfo;
		$this->load_view('profile/index' , '' , '' , $contentData);
	}
	public function privacy() {
		$contentData = array();
		$contentData['user_submenu'] = true;
		$this->load_view('account_settings/privacy_security' , '' , 'Privacy_and_Security' , $contentData);
	}
	public function saveUsername() {
	    $param = $this->input->post();
	    $userid = $this->session->userdata('USERID');
        $ret = array();
        $code = $this->Users_Model->saveUserName($userid, $param['username']);
        if($code == false) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your account infomation is not correct. Please check again.';
            echo json_encode($ret);
            return;
        }
        // change current session
        $this->session->set_userdata('USERNAME', $param['username']);
        $ret['error_code'] = 0;
        $ret['link'] = site_url('/Profile');
        echo json_encode($ret);
    }
    public function saveEmail() {
        $param = $this->input->post();
        $userid = $this->session->userdata('USERID');
        $ret = array();
        // email duplicate check
        $result = $this->Users_Model->getUserInfobyEmail($param['email']);
        if(count($result) > 0) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your email address is used already. Please type other email.';
            echo json_encode($ret);
            return;
        }
        $code = $this->Users_Model->saveEmail($userid, $param['email']);
        if($code == false) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your account infomation is not correct. Please check again.';
            echo json_encode($ret);
            return;
        }
        // change current session
        $this->session->set_userdata('EMAIL', $param['email']);
        $ret['error_code'] = 0;
        $ret['link'] = site_url('/Profile');
        echo json_encode($ret);
    }
    public function saveSecurity() {
        $param = $this->input->post();
        $userid = $this->session->userdata('USERID');
        $ret = array();
        // check old password
        $userInfo = $this->Users_Model->getUserInfobyUserid($userid);
        if(md5($param['old_password']) != $userInfo['PASSWORD']) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Old password is not correct. Please check old password.';
            echo json_encode($ret);
            return;
        }
        $code = $this->Users_Model->saveSecurity($userid, $param['new_password']);
        if($code == false) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = 'Your account infomation is not correct. Please check again.';
            echo json_encode($ret);
            return;
        }
        $ret['error_code'] = 0;
        $ret['link'] = site_url('/Profile');
        echo json_encode($ret);
    }
    public function saveAvatar() {
        $userId = $this->session->userdata('USERID');
        $userInfo = $this->Users_Model->getUserInfobyUserid($userId);
        $ret = array();
        $config['upload_path'] = realpath(APPPATH.'../uploads/profile/');
        $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
        $config['max_size'] = '100';
        $config['max_width']  = '500';
        $config['max_height']  = '500';
        $config['file_name'] = "avatar_".$userId.date("YmdHis");
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('avatar_file')) {
            $ret['error_code'] = 1;
            $ret['res_msg'] = $this->upload->display_errors();
            echo json_encode($ret);
            return;
        }else {
            // delete old avatar
            $old_avatar = realpath(APPPATH."../uploads/profile/".$userInfo['AVATAR']);
            if($userInfo['AVATAR'] != '')
                @unlink($old_avatar);
            $upload_data = $this->upload->data();
            $avatar = $upload_data['file_name'];
            $this->Users_Model->saveAvatar($userId, $avatar);
            // change current session
            $this->session->set_userdata('AVATAR', $avatar);
            $ret['error_code'] = 0;
            $ret['link'] = '/Profile';
            echo json_encode($ret);
            return;
        }

    }
}
