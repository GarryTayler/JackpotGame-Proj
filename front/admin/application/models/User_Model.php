<?php

class User_Model extends MY_Model {
    public $table = 'users';
    public $searchFields = array();

    function __construct() {
        parent::__construct();

        $this->searchFields = explode(', ', 'user_name, user_email');
    }

    function table_data($start, $limit, $sort = array(), $query = array()) {
        if (isset($query['generalSearch'])) {
            $generalSearch = $query['generalSearch'];
            unset($query['generalSearch']);
        } else {
            $generalSearch = '';
        }
        if (!empty($query)) {
            $this->where($query);
        }
        $this->db->where('user_role', 'USER');

        return $this->_table_data($this->table, $start, $limit, $sort, $generalSearch, $this->searchFields);
    }

    function count_data($query) {
        if (isset($query['generalSearch'])) {
            $generalSearch = $query['generalSearch'];
            unset($query['generalSearch']);
        } else {
            $generalSearch = '';
        }
        if (!empty($query)) {
            $this->where($query);
        }

        return $this->_count_data($this->table, $generalSearch, $this->searchFields);
    }
}
