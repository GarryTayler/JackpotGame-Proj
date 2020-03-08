<?php

class Faq_Model extends MY_Model {
    public $table = 'faq';
    function __construct()
    {
        parent::__construct();
    }
    /**
     * get faq list
     * @return array
     * @param $page, $pageSize, $from, $to, $orderby, $direction
    */
    function getFaqs($page=1, $pageSize=10, $from='', $to='', $orderby = '', $direction = '') {
        $start = ($page - 1) * $pageSize;
        $orderby = ($orderby == '') ? 'update_time' : $orderby;
        $direction = ($direction == '') ? 'DESC' : '';
        if($from != '')
            $this->db->where('update_time >=', $from);
        if($to != '')
            $this->db->where('update_time <=', $to);
        $result = $this->db
            ->where('deleted <>', '1')
            ->order_by($orderby, $direction)
            ->get($this->table, $pageSize, $start)
            ->result_array();

        $ret = array();
        foreach($result as $item) {
            $newItem = $item;
            $newItem['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
            $newItem['update_time'] = date('Y-m-d H:i:s', $item['update_time']);
            $ret[] = $newItem;
        }
        return $ret;
    }
    /**
     * get total count of faqs
     * @return int
     * @param $from, $to
    */
    function getFaqsCount($from = '', $to = '') {
        if($from == '' || $to == '') {
            $count = $this->db
                ->where('deleted <>', '1')
                ->get($this->table)
                ->num_rows();
        }else {
            $count = $this->db
                ->where('deleted <>', '1')
                ->where('update_time >=', $from)
                ->where('update_time <', $to)
                ->get($this->table)
                ->num_rows();
        }
        return $count;
    }

    /**
     * get faq by id
     * @return mixed
     * @param $id
    */
    function getFaq($id) {
        $result = $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row_array();
        return $result;
    }

    /**
     * update faq
     * @return boolean
     * @param $id, $data
    */
    function updateFaq($id, $data) {
        $data['update_time'] = time();
        $ret = $this->db
            ->where('id', $id)
            ->update($this->table, $data);
        return $ret;
    }

    /**
     * insert new faq
     * @return boolean
     * @param $data
    */
    function insertFaq($data) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $ret = $this->db
            ->insert($this->table, $data);
        return $ret;
    }
    /**
     * delete faq by id
     * @return boolean
     * @param $id
    */
    function deleteFaq($id){
        $ret = $this->db
            ->where('id', $id)
            ->set('deleted', 1)
            ->update($this->table);
        return $ret;
    }
}
