<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
        $contentData['sidebar'] = true;
        $contentData['game_type'] = 'jackpot';
        $this->load_view('game/jackpot/index' , 'home' , '' , $contentData);
	}
}
