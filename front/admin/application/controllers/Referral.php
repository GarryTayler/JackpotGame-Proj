<?php

class Referral extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variable_Model');
        $this->load->model('Users_Model');
        // to do here load Referral model

    }
    /**
     * render referral index page
     * @response html
     * @request get
     */
    public function index()
    {
        $totalCount = $this->Users_Model->getUsersCount(); //fixme later......
        $pageParams = array(
            'page' => 1,
            'pageSize' => 10,
            'totalCount' => $totalCount
        );
        $this->render('referral/index', 'Referral', 'referral', $pageParams);
    }
    /**
     * render referral setting page
     * @response html
     * @request get
     */
    public function setting()
    {
        $contentData = array();
        // get referral
        $referralPercInfo = $this->Variable_Model->getVariable('', 'REFERAL_PERCENTAGE');
        $withdrawalFeeInfo = $this->Variable_Model->getVariable('', 'WITHDRAWAL_FEE');
        $contentData['referralPercInfo'] = $referralPercInfo['value'];
        $contentData['withdrawalFeeInfo'] = $withdrawalFeeInfo['value'];
        $this->render('referral/setting', 'Referral Setting', 'referral_setting', $contentData);
    }
    /**
     * save referral setting
     * @response json
     * @request post
     * @param key , value
     */
    public function ajax_save_setting()
    {
        $params = $this->input->post();
        $this->Variable_Model->updateVariable($params['key'], $params['value']);
        $ret = array('errorCode'=>0);
        echo json_encode($ret);
    }

    /**
     * save referral records; use pagination method in User.php
     * @response json
     * @request post
     * @param key , value
     */
    public function ajax_get_referral() {
        $ret = array('totalCount' => 1, 'referralList' => []);
        echo json_encode($ret);
    }
}