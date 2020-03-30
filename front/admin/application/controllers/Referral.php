<?php

class Referral extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variable_Model');
        $this->load->model('Deposit_Withdraw_Log_Model');
        // to do here load Referral model

    }

    /**
     * render referral index page
     * @response html
     * @request get
     */
    public function index()
    {
        $join = array(
            array('users', 'USER_ID=users.ID', 'left'),
        );

        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount('3', '', '', '', $join);
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
        $adminFeeInfo = $this->Variable_Model->getVariable('', 'ADMIN_FEE');
        $contentData['referralPercInfo'] = $referralPercInfo['VALUE'];
        $contentData['withdrawalFeeInfo'] = $withdrawalFeeInfo['VALUE'];
        $contentData['adminFeeInfo'] = $adminFeeInfo['VALUE'];
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
        if ($this->Variable_Model->existVariable($params['key'])) {
            $this->Variable_Model->updateVariable($params['key'], $params['value']);
        } else {
            $this->Variable_Model->insertVariable($params['key'], $params['value']);
        }

        $ret = array('errorCode' => 0);
        echo json_encode($ret);
    }

    /**
     * save referral records; use pagination method in User.php
     * @response json
     * @request post
     * @param key , value
     */
    public function ajax_get_referral()
    {
        // $type = 1, $page = 1, $pageSize = 10, $from = '', $to = '', $orderby = '', $direction = '', $join = null
        $params = $this->input->post();
        // pagination parameters
        $page = isset($params['page']) ? $params['page'] : 1;
        $page = ($page == '') ? 1 : $page;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        // search parameters
        $searchValue = isset($params['searchValue']) ? $params['searchValue'] : '';
        // order parameters
        $orderby = isset($params['orderby']) ? $params['orderby'] : 'deposit_withdraw_log.UPDATE_TIME';
        $direction = isset($params['direction']) ? $params['direction'] : '';
        // get total count of users
        $join = array(
            array('users', 'USER_ID=users.ID', 'left'),
        );

        $where = '1 = 1';
        $where .= ' AND (users.EMAIL LIKE "%' . $searchValue . '%"';
        $where .= ' OR users.USERNAME LIKE "%' . $searchValue . '%")';

        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount('3', '', '', $where, $join);
        // get user list
        $referralList = $this->Deposit_Withdraw_Log_Model->getLogs('3', $page, $pageSize, "", "", $orderby, $direction, $where, $join);
        $ret = array('totalCount' => $totalCount, 'referralList' => $referralList);
        echo json_encode($ret);
    }
}