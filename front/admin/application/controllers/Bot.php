<?php

class Bot extends MY_Controller {
    public function index() {
        $this->render('bots', 'Bots', 'bots');
    }
}