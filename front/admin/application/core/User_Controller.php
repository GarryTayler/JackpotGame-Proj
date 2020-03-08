<?php

class User_Controller extends MY_Controller {
    function __construct() {
        parent::__construct();

        // check for authorization
        // if not logged in,
        if (!$this->user_data) {
            $controller = strtolower($this->uri->rsegment(1));
            if ($controller == 'auth' || $controller == 'home') {
                return;
            }
            // then back to home (and ask for login)
            redirect('/');
        }
    }
    
    protected function render_template($path, $title, $view_data = array()) {
        $data = array(
            'title' => $title,
            'view_path' => $path,
            'view_data' => $view_data
        );
        $this->load->view('front/template/layout', $data);
    }
}