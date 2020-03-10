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
}
