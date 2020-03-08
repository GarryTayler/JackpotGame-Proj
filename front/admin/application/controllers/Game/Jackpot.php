<?php

class Jackpot extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jackpot_Model');
    }
    /**
     * render game history index page
     * @response html
     * @request get
    */
    public function index() {
        $totalCount =$this->Jackpot_Model->getGamesCount();
        $contentData = array(
            'page' => 1,
            'pageSize' => 10,
            'totalCount'=>$totalCount
        );
        $this->render('game/jackpot', 'Jackpot History', 'jackpot', $contentData);
    }
    /**
     * get game histories
     * @response json
     * @request post
     * @param [page], [pageSize], [from], [to] [orderby], [direction]
    */
    public function ajax_get_histories() {
        $params = $this->input->post();
        // pagination parameters
        $page = isset($params['page']) ? $params['page'] : 1;
        $page = ($page == '') ? 1 : $page;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        // search parameters
        $from = isset($params['from']) ? strtotime($params['from']) : '';
        $to = isset($params['to']) ? strtotime($params['to']) : '';
        // order parameters
        $orderby = isset($params['orderby']) ? $params['orderby'] : '';
        $direction = isset($params['direction']) ? $params['direction'] : '';
        // get total count of game history
        $totalCount = $this->Jackpot_Model->getGamesCount($from, $to);
        // get game history list
        $historyList = $this->Jackpot_Model->getGames($page, $pageSize,$from, $to, $orderby, $direction);
        $ret = array('totalCount'=>$totalCount, 'historyList'=>$historyList);
        echo json_encode($ret);
    }
    /**
     * get game logs
     * @response json
     * @request post
     * @param gameid
    */
    public function ajax_get_logs() {
        $params = $this->input->post();
        $gameid = isset($params['gameid']) ? $params['gameid'] : '';
        $logList = $this->Jackpot_Model->getGameLogs($gameid);
        $ret = array('totalCount'=>count($logList), 'logList'=>$logList);
        echo json_encode($ret);
    }
    /**
     * delete game history
     * @response json
     * @request post
     * @param gameid
     */
    public function ajax_del_history() {
        $params = $this->input->post();
        $gameid = isset($params['gameid']) ? $params['gameid'] : '';
        $this->Jackpot_Model->deleteGame($gameid);
        $ret = array('errorCode'=>0);
        echo json_encode($ret);
    }

}