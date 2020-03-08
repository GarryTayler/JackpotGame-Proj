<?php

class Deposit extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Deposit_Withdraw_Log_Model');
    }
    /**
     * render deposit index page
     * @response html
     * @request get
    */
    public function index() {
        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount(1);
        $pageParams = array(
            'page' => 1,
            'pageSize' => 10,
            'totalCount' => $totalCount
        );
        $this->render('deposit/index', 'Deposit', 'deposit', $pageParams);
    }
    /**
     * get deposit logs
     * @response json
     * @request post
     * @param [page], [pageSize], [searchValue], [orderby], [direction]
    */
    public function ajax_get_logs() {
        $params = $this->input->post();
        // pagination parameters
        $page = isset($params['page']) ? $params['page'] : 1;
        $page = ($page == '') ? 1 : $page;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        // search parameters
        $from = isset($params['from']) ? strtotime($params['from']) : '';
        $to = isset($params['to']) ? strtotime($params['to']) + 86400 : '';

        // order parameters
        $orderby = isset($params['orderby']) ? $params['orderby'] : '';
        $direction = isset($params['direction']) ? $params['direction'] : '';

        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount(1, $from, $to);
        $logsList = $this->Deposit_Withdraw_Log_Model->getLogs(1, $page, $pageSize, $from, $to, $orderby, $direction);
        $ret = array('totalCount'=>$totalCount, 'logsList'=>$logsList);
        echo json_encode($ret);
    }
    /**
     * delete deposit log
     * @response json
     * @request post
     * @param logid
    */
    public function ajax_del_log() {
        $params = $this->input->post();
        $logid = isset($params['id']) ? $params['id'] : '';
        $this->Deposit_Withdraw_Log_Model->deleteLog($logid);
        $ret = array('errorCode'=>0);
        echo json_encode($ret);
    }
}