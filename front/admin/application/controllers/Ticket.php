<?php

class Ticket extends MY_Controller {
    public function index() {
        $this->render('ticket', 'Tickets', 'ticket');
    }
}