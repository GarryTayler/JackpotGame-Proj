<?php

class Deposit extends MY_Controller {
    public function index() {
        $this->custom_css[] = 'assets/dist/css/pages/tab-page.css';
        $this->render('finance/deposits', 'Deposits', 'deposit');
    }

    public function setting() {
        $setting = array();
        $inputs = array();
        foreach (
            array(
                'allow_auto' => 'Allow automated deposits',
                'allow_manual' => 'Allow manual deposits',
                'allow_bitcoin' => 'Allow bitcoin deposits',
                'allow_novinpal' => 'Allow NovinPal deposits',
                'allow_paypal' => 'Allow Paypal deposits',
                'allow_skrill' => 'Allow Skrill deposits'
            ) as $name => $title
        ) {
            $inputs[] = array(
                'title' => $title,
                'name' => $name,
                'tag' => 'select',
                'options' => array(1 => 'Yes', 0 => 'No')
            );
            $setting[$name] = 1;
        }
        $inputs[] = array(
            'title' => 'Lowest amount for deposit',
            'name' => 'lowest_deposit',
            'type' => 'number'
        );
        $setting['lowest_deposit'] = 0.1;

        $inputs[] = array(
            'title' => 'Highest amount for deposit',
            'name' => 'highest_deposit',
            'type' => 'number'
        );
        $setting['highest_deposit'] = 50000;

        $data = array(
            'setting' => $setting,
            'inputs' => $inputs
        );
        $this->render('finance/deposit_setting', 'Deposit Settings', 'deposit_setting', $data);
    }
}
