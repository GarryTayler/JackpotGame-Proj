<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variable_Model', 'variable');
    }

    public function index()
    {
        $contentData['sidebar'] = true;
        $html = $this->variable->getContent('terms_conditions');
        if (isset($html['VALUE'])) {
            $contentData['content'] = $html['VALUE'];
        } else {
            $contentData['content'] = '';
        }
        $this->load_view('terms/index', 'terms', '', $contentData);
    }
}
