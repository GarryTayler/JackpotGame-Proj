<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
        $contentData = array();
        $contentData['user_submenu'] = false;
		$this->load_view('referrals/index' , 'referral' , '' , $contentData);
    }
	
}