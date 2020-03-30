<?php

class Jackpot_Model extends MY_Model {
    protected $game_table = 'jackpot_game';
    protected $log_table = 'jackpot_game_log';
    protected $user_table = 'users';

    public function __construct() {
        parent::__construct();
    }
    /**
     * get game history list
     * @return array
     * @param $page, $pageSize, $from, $to, $orderby, $direction
    */
    public function getGames($page=1, $pageSize=10, $from='', $to='', $orderby = '', $direction = '') {
        $start = ($page - 1) * $pageSize;
        $orderby = ($orderby == '') ? 'UPDATE_TIME' : $orderby;
        $direction = ($direction == '') ? 'DESC' : '';
        if($from != '')
            $this->db->where('UPDATE_TIME >=', $from);
        if($to != '')
            $this->db->where('UPDATE_TIME <=', $to);
        $result = $this->db
            ->where('DEL_YN', 'N')
            ->order_by($orderby, $direction)
            ->get($this->game_table, $pageSize, $start)
            ->result_array();
        // note: don't use join code
        $ret = array();
        foreach($result as $item) {
            $newItem = $item;
            $winner_info = $this->db
                ->where('ID', $item['WINNER'])
                ->get($this->user_table)
                ->row_array();
            $newItem['WINNER_USERNAME'] = $winner_info['USERNAME'];
            $newItem['WINNER_EMAIL'] = $winner_info['EMAIL'];
            $ret[] = $newItem;
        }
        return $ret;
    }

    /**
     * get total count of game history list
     * @return int
     * @param $from, $to
    */
    public function getGamesCount($from = '', $to = '') {
        if($from != '')
            $this->db->where('UPDATE_TIME >=', $from);
        if($to != '')
            $this->db->where('UPDATE_TIME <=', $to);
        $count = $this->db
            ->from($this->game_table)
            ->where('DEL_YN', 'N')
            ->get()
            ->num_rows();
        return $count;
    }

    /**
     * get game log by game id
     * @return array
     * @param $gameId
    */
    public function getGameLogs($gameId) {
        $bet_result = $this->db
            ->from($this->game_table)
            ->where('ID', $gameId)
            ->get()
            ->row_array();

        $result = $this->db
            ->from($this->log_table)
            ->where('GAMEID', $gameId)
            ->get()->result_array();

        $ret = array();
        foreach($result as $item) {
            $newItem = $item;
            $userInfo = $this->db
                ->where('ID', $item['USERID'])
                ->get($this->user_table)
                ->row_array();
            if($item['USERID'] == $bet_result['WINNER']) {
                $newItem['RESULT'] = 'WIN';
            }else {
                $newItem['RESULT'] = 'LOSE';
            }
            $newItem['USERNAME'] = $userInfo['USERNAME'];
            $newItem['EMAIL'] = $userInfo['EMAIL'];
            $newItem['CREATE_TIME'] = date("Y-m-d H:i:s", $newItem['CREATE_TIME']);
            $newItem['PROFIT'] = number_format($newItem['PROFIT']);
            $newItem['BET_AMOUNT'] = number_format($newItem['BET_AMOUNT']);
            $ret[] = $newItem;
        }
        return $ret;
    }

    /**
     * delete game from game history list
     * @return boolean
     * @param $gameId
    */
    public function deleteGame($gameId) {
        $ret = $this->db
            ->from($this->game_table)
            ->where('ID', $gameId)
            ->set('DEL_YN', 'Y')
            ->update();
        return $ret;
    }
}
