<?php

class Withdraw extends MY_Controller {
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
        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount(2);
        $pageParams = array(
            'page' => 1,
            'pageSize' => 10,
            'totalCount' => $totalCount
        );
        $this->render('withdraw/index', 'Withdraw', 'withdrawal', $pageParams);
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

        $totalCount = $this->Deposit_Withdraw_Log_Model->getLogsCount(2, $from, $to);
        $logsList = $this->Deposit_Withdraw_Log_Model->getLogs(2, $page, $pageSize, $from, $to, $orderby, $direction);
        $list = array();
        foreach($logsList as $log) {
            $log['AMOUNT_COINS'] = number_format($log['AMOUNT_COINS']);
            $list[] = $log;
        }
        $ret = array('totalCount'=>$totalCount, 'logsList'=>$list);
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

    public function ajax_confirm_transaction() {
        $id = $this->getParam('id', '');
        if ($id == '') {
            $ret['errorCode'] = 1;
            $ret['msg'] = 'Invalid Record ID';
        } else {
            $this->Deposit_Withdraw_Log_Model->updateLog($id, array('STATUS' => 2));
            $ret['errorCode'] = 0;
        }
        echo json_encode($ret);
    }


}