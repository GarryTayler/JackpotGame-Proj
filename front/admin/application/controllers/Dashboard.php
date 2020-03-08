<?php

class Dashboard extends MY_Controller {
    public function index() {
        $this->custom_css[] = array();
        $this->render('dashboard', 'Dashboard', 'dashboard');
    }
}