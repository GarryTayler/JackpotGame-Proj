<?php

class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_Model');
    }
    /**
     * render dashboard page
     * @response html
     * @request get
     * @param void
     */
    public function index() {
        $from = strtotime(date("Y-m-d 00:00:00"));
        $to = strtotime(date("Y-m-d 23:59:59"));
        $newUsers = $this->Users_Model->countNewUsers($from, $to);
        file_put_contents("1.txt", $newUsers);
        $contentData = array('newUsers'=>$newUsers);
        $this->render('dashboard', 'Dashboard', 'dashboard', $contentData);
    }
}