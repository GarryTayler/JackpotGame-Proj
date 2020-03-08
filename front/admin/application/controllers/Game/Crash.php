<?php

class Crash extends MY_Controller {
    public function index() {
        $this->render('game/crash', 'Crash History', 'crash');
    }

    public function setting() {
        $this->render('game/crash_setting', 'Crash Settings', 'crash_setting');
    }
}