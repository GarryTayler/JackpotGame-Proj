<?php
class Variable_Model extends CI_Model {

 	public $table = "variable";

	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}

	function getContent($where) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('VARIABLE' , $where);
        $result = $this->db->get()->row_array();
        return $result;
    }
}
