<?php

class Deposit_Withdraw_Log_Model extends MY_Model {
    protected $log_table = 'deposit_withdraw_log';
    protected $user_table = 'users';


    function __construct()
    {
        parent::__construct();
    }
    /**
     * get deposit or withdraw log list
     * @return array
     * @param $page, $pageSize, $from, $to, $orderby, $direction
    */
    function getLogs($type = 1, $page = 1, $pageSize = 10, $from = '', $to = '', $orderby='', $direction='') {
        $start = ($page - 1) * $pageSize;
        $orderby = ($orderby == '') ? 'UPDATE_TIME' : $orderby;
        $direction = ($direction == '') ? 'DESC' : '';
        if($from != '')
            $this->db->where('UPDATE_TIME >=',$from);
        if($to != '')
            $this->db->where('UPDATE_TIME <=',$to);
        $result = $this->db
            ->where('TYPE', $type)
            ->order_by($orderby, $direction)
            ->get($this->log_table, $start, $pageSize)
            ->result_array();
        // note: don't use join code
        $ret = array();
        foreach($result as $item) {
            $newItem = $item;
            $userInfo = $this->db
                ->where('ID', $item['USER_ID'])
                ->get($this->user_table)
                ->row_array();
            $newItem['USERNAME'] = $userInfo['USERNAME'];
            $newItem['EMAIL'] = $userInfo['EMAIL'];
            $ret[] = $newItem;
        }
        return $ret;
    }
    /**
     * get total count of deposit or withdraw logs
     * @return int
     * @param $from, $to
    */
    function getLogsCount($type = 1, $from='', $to='') {
        if($from != '')
            $this->db->where('UPDATE_TIME >=',$from);
        if($to != '')
            $this->db->where('UPDATE_TIME <=',$to);
        $count = $this->db
            ->where('TYPE', $type)
            ->get($this->log_table)
            ->num_rows();
        return $count;
    }
    /**
     * delete log by id
     * @return boolean
     * @param $id
    */
    function deleteLog($id) {
        $ret = $this->db
            ->where('ID', $id)
            ->delete($this->log_table);
        return $ret;
    }
    /**
     * update Log information
     * @return boolean
     * @param $id, $data
     */
    function updateLog($id, $data) {
        $ret = $this->db
            ->where('ID', $id)
            ->update($this->log_table, $data);
        return $ret;
    }

}
