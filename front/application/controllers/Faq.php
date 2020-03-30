<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function index() {
        $contentData = array();
        $this->load_view('faq/index' , 'faq' , '' , $contentData);
	}
	public function get_list() {
		$query = "select * from faq where deleted = 0";
		$result = $this->db->query($query);
		$result = $result->result_array();
		echo json_encode(array('status'=>'success', 'data' => $result));
		return;
	}
}
