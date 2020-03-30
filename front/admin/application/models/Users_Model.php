<?php

class Users_Model extends MY_Model {
    public $table = 'users';
    public $searchFields = array();

    function __construct() {
        parent::__construct();
    }

    /**
     * get user list
     * @return array
     * @param $searchKey, $searchValue, $page, $pageSize, $orderby, $direction
    */
    function getUsers($searchValue= '', $page=1, $pageSize = 10, $orderby='', $direction='') {
        $start = ($page - 1) * $pageSize;
        $orderby = ($orderby == '') ? 'ID' : $orderby;
        $this->db->where('DEL_YN', 'N');
        if($searchValue != '') { // %LIKE% portion of the query
            $this->db->like('USERNAME', $searchValue)
                ->or_like('EMAIL', $searchValue);
        }
        $this->db->order_by($orderby, $direction);
        $result = $this->db
            ->get($this->table, $pageSize, $start)
            ->result_array();
        return $result;
    }
    /**
     * get total count of users
     * @return int
     * @param $searchValue
    */
    function getUsersCount($searchValue='') {
        $this->db->where('DEL_YN', 'N');
        if($searchValue != '') {
            $this->db->like('USERNAME', $searchValue)
                ->or_like('EMAIL', $searchValue);
        }
        $count = $this->db
            ->get($this->table)
            ->num_rows();
        return $count;
    }
    /**
     * get user information by id
     * @return mixed
     * @param $id
    */
    function getUser($id) {
        $result = $this->db
            ->where('ID', $id)
            ->get($this->table)
            ->row_array();
        return $result;
    }
    /**
     * check id is exist in user table
     * @return boolean
     * @param $id
    */
    function existUser($id) {
        $count = $this->db
            ->where('ID', $id)
            ->get($this->table)
            ->num_rows();
        return $count > 0;
    }
    /**
     * update user information
     * @return boolean
     * @param $id, $data
    */
    function updateUser($id, $data) {
        if(isset($data['PASSWORD'])) {
            $data['PASSWORD'] = md5($data['PASSWORD']);
        }
        $ret = $this->db
            ->where('ID', $id)
            ->update($this->table, $data);
        return $ret;
    }
    /**
     * insert new user
     * @return boolean
     * @param $data
    */
    function insertUser($data) {
        // check duplicate of username or email
        $count = $this->db
            ->where('USERNAME', $data['USERNAME'])
            ->or_where('EMAIL', $data['EMAIL'])
            ->get($this->table)
            ->num_rows();
        if($count > 0)
            return false;
        $ret = $this->db
            ->insert($this->table, $data);
        return $ret;
    }
    /**
     * delete user
     * @return boolean
     * @param $id
    */
    function deleteUser($id) {
        $ret = $this->db
            ->where('ID', $id)
            ->set('DEL_YN', 'Y')
            ->update($this->table);
        return $ret;
    }
    /**
     * get count of new users
     * @return int
     * @param $from, $to
    */
    function countNewUsers($from, $to) {
        $count = $this->db
            ->where('CREATE_TIME >=', $from)
            ->where('CREATE_TIME <=', $to)
            ->get($this->table)
            ->num_rows();
        return $count;
    }
}
