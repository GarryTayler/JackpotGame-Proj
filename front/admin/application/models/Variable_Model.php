<?php

class Variable_Model extends MY_Model {
    public $table = 'variable';
    function __construct()
    {
        parent::__construct();
    }

    /**
     * get all variable list
     * @return mixed
     * @param void
    */
    function getVariables() {
        $result = $this->db
            ->get($this->table)
            ->result_array();
        return $result;
    }
    /**
     * get variable by id or key
     * @return mixed
     * @param $id or $key
     * */
    function getVariable($id = '', $key = '') {
        if($id != '') {
            $ret = $this->db
                ->from($this->table)
                ->where('ID', $id)
                ->get()
                ->row_array();
            return $ret;
        }else if($key != '') {
            $ret = $this->db
                ->from($this->table)
                ->where('VARIABLE', $key)
                ->get()
                ->row_array();
            return $ret;
        }else{
            return false;
        }
    }

    /**
     * update variable
     * @return boolean
     * @param $key, $value
     * */
    function updateVariable($key, $value) {
        $ret = $this->db
            ->from($this->table)
            ->where('VARIABLE', $key)
            ->set('VALUE', $value)
            ->update();
        return $ret;
    }
    /**
     * insert new variable
     * @return boolean
     * @param $key, $value
    */
    function insertVariable($key, $value) {
        // check duplicate of this key
        $count = $this->db
            ->from($this->table)
            ->where('VARIABLE', $key)
            ->get()->num_rows();
        if($count > 0) {
            return false;
        }
        $ret = $this->db
            ->insert($this->table, array('VARIABLE'=>$key, 'VALUE'=>$value));
        return $ret;
    }

    /**
     * check the key is exist in table
     * @return boolean
     * @param $key
    */
    function existVariable($key) {
        $count = $this->db
            ->where('VARIABLE', $key)
            ->get($this->table)->num_rows();
        return $count > 0;
    }
}
