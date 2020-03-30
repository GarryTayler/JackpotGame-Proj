<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WithDraw extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if( !(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
			redirect('Login');
			return;
		}
	}
	public function index() {
        $contentData['sidebar'] = true;
		$contentData['game_type'] = 'jackpot';
		$contentData['available_wallet_coin'] = number_format($this->session->userdata('WALLET') , 0 , '.' , ' ');
		$contentData['available_wallet_btc'] = number_format($contentData['available_wallet_coin'] / 1000000 , 6 , '.' , '');
        $this->load_view('withdraw/index' , 'withdraw' , '' , $contentData);
	}
	public function withdrawRequest() {
		$info = $this->input->post();
		$who = $this->session->userdata('USERID');

		$param_data = array();
		$param_data['who'] = $who;
		$param_data['to_address'] = $info['to_address'];
		$param_data['amount'] = $info['amount'];
		$param_data['amount_coins'] = intval(doubleval($info['amount']) * pow(10, 6));
		$json = json_encode($param_data);

		$host = MAIN_SERVER_URL."api/btc/withdraw_request";
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
		echo json_encode(array('status' => 'success' , 'data' => $ret));
	}
}
