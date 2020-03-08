<?php
class Queue_Model extends CI_Model {
    public $QUEUE = "queue";
    public $QUEUE_BACKUP = "queue_backup";

	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}
	public function insertQueue($type , $action , $param , $userid) 
	{
        $data = array();
        $data['UPDATE_TIME'] = $data['CREATE_TIME'] = time();
        $data['TYPE'] = $type;
        $data['ACTION'] = $action;
        $data['PARAM'] = $param;
        $data['USERID'] = $userid;
        $this->db->insert($this->QUEUE , $data);
        $this->db->insert($this->QUEUE_BACKUP , $data);
        return true;
    }	    
}
