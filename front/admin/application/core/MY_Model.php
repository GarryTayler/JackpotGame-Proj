<?php

class MY_Model extends CI_Model {
    public $table = '';
    public $searchFields = array();

    function _get($table, $id) {
        return $this->db->from($table)->where('id', $id)->get()->row();
    }

    function _all($table) {
        return $this->db->from($table)->where('deleted', 0)->get()->result();
    }

    function _table_data($table, $start, $limit, $sort = array(), $generalSearch = '', $searchFields = array()) {
        if ($generalSearch != '') {
            $this->_do_search($generalSearch, $searchFields);
        }
        if (!empty($sort)) {
            // $this->db->order_by($sort['field'], $sort['sort']);
        }
        return $this->db->from($table)->where('deleted', 0)->limit($limit, $start)->get()->result();
    }

    function _delete($table, $id) {
        $this->db->update($table, array('deleted' => 1, 'updated_at' => str_cur_time()), array('id' => $id));
    }

    function _update($table, $id, $row) {
        $row['updated_at'] = str_cur_time();
        return $this->db->update($table, $row, array('id' => $id));
    }

    function _save($table, $row) {
        $row['created_at'] = $row['updated_at'] = str_cur_time();
        return $this->db->insert($table, $row);
    }

    function _count_data($table, $generalSearch = '', $searchFields = array()) {
        if ($generalSearch != '') {
            $this->_do_search($generalSearch, $searchFields);
        }
        return $this->db->from($table)->where('deleted', 0)->count_all_results();
    }

    function _do_search($generalSearch, $searchFields) {
        if ($generalSearch == '') return;
        $this->db->group_start();
        foreach ($searchFields as $field) {
            $this->db->or_like($field, $generalSearch, 'both');
        }
        $this->db->group_end();
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

    function all($count = 0) {
        if ($count) {
            $this->db->limit($count);
        }
        return $this->db->from($this->table)->where('deleted', 0)->get()->result();
    }

    function get($id) {
        return $this->_get($this->table, $id);
    }
}
