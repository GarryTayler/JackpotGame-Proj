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
        $this->load_view('withdraw/index' , 'withdraw' , '' , $contentData);
    }
}
