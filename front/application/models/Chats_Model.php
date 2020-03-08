<?php
class Chats_Model extends CI_Model {

 	public $CHATS = "chats";
	public $USERS = "users";

	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}

	function getChatList( $type ) {

		$current_date = getCurrentTimeStamp();

		

		$this->db->select("chats.CREATE_TIME , chats.MSG , users.USERNAME , users.AVATAR");
		$this->db->from($this->CHATS);
		$this->db->join($this->USERS , 'users.ID = chats.USERID');
		$this->db->where('chats.DEL_YN' , 'N');
		$this->db->where('chats.CHAT_TYPE' , $type);
		$this->db->where('chats.CREATE_TIME >=' , $current_date);
		$this->db->limit(10);

		$result = $this->db->get()->result_array();
		return $result;

	}

}
