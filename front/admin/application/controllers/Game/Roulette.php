<?php

class Roulette extends MY_Controller {
    public function index() {
        $this->render('game/roulette', 'Roulette History', 'roulette');
    }

    public function setting() {
        $this->render('game/roulette_setting', 'Roulette Settings', 'roulette_setting');
    }
}