<?php

class Withdrawal extends MY_Controller {
    public function index() {
        $this->render('finance/withdrawals', 'Withdrawal Settings', 'withdrawal');
    }

    public function setting() {
        $setting = array();
        $inputs = array();
        $inputs[] = array(
            'title' => 'Lowest amount for withdraw request',
            'name' => 'lowest_withdraw',
            'type' => 'number'
        );
        $setting['lowest_withdraw'] = 0.0001;

        $inputs[] = array(
            'title' => 'Highest amount for withdraw request',
            'name' => 'highest_withdraw',
            'type' => 'number'
        );
        $setting['highest_withdraw']  = 30000;

        foreach (
            array(
                'allow_withdraw' => 'Allow withdraws',
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
        $data = array(
            'setting' => $setting,
            'inputs' => $inputs
        );
 
        $this->render('finance/withdrawal_setting', 'Deposit Settings', 'withdrawal_setting', $data);
    }
}
