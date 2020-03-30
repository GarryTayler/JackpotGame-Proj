<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends MY_Controller {
    public function __construct()
    {
			parent::__construct();
			if( !(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
				redirect('Login');
				return;
			}
    }
    public function index() {
        $contentData = array();
        $this->load_view('deposit/index' , 'deposit' , '' , $contentData);
	}
	public function getWalletAddress() {
		$who = $this->session->userdata('USERID');
		$param_data = array();
		$param_data['who'] = $who;
		$json = json_encode($param_data);
		$host = MAIN_SERVER_URL."api/btc/get_deposit_address";
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
