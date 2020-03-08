<?php

class Ladder extends MY_Controller {
    public function index() {
        $this->render('game/ladder', 'Ladder History', 'ladder');
    }

    public function setting() {
        $this->render('game/ladder_setting', 'Ladder Settings', 'ladder_setting');
    }
}