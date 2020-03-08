<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function index() {
        $contentData = array();
        $this->load_view('deposit/index' , 'deposit' , '' , $contentData);
    }
}