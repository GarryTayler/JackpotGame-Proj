<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if( !(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
			redirect('Login');
			return;
		}
	}
	public function index() {
        $contentData = array();
        $contentData['user_submenu'] = false;
		$this->load_view('referrals/index' , 'referral' , '' , $contentData);
    }
}
