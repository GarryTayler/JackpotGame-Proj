<?php

class Faq extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Faq_Model');
    }
    /**
     * render faq index page
     * @response html
     * @request get
    */
    public function index() {
        $contentData = array();
        $this->render('faq/index', 'Faq', 'faq', $contentData);
    }
    /**
     * render create new faq page
     * @response html
     * @request get
    */
    public function create() {
        $contentData = array();
        $this->render('faq/edit', 'Faq', 'faq', $contentData);
    }

    /**
     * render edit new faq page
     * @response html
     * @request get
     * @param faqid
     */
    public function edit() {
        $params = $this->input->get();
        $faqId = isset($params['faqid']) ? $params['faqid'] : '';
        $ret = array();
        if($faqId == '') {
            // to do here go to error page
            return;
        }
        $faqInfo = $this->Faq_Model->getFaq($faqId);
        $contentData = array();
        $contentData['faqInfo'] = $faqInfo;
        $this->render('faq/edit', 'Faq', 'faq', $contentData);
    }
    /**
     * get faq list
     * @response html
     * @request post
     * @param [$page], [$pageSize]
    */
    public function ajax_get_faqs() {
        $params = $this->input->post();
        // pagination parameters
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        // orderby parameters
        $orderby = isset($params['orderby']) ? $params['orderby'] : '';
        $direction = isset($params['direction']) ? $params['direction'] : '';
        $totalCount = $this->Faq_Model->getFaqsCount();
        $faqList = $this->Faq_Model->getFaqs($page, $pageSize, '', '', $orderby, $direction);
        $ret = array('totalCount'=>$totalCount, 'faqList'=>$faqList);
        echo json_encode($ret);
    }
    /**
     * save faq
     * @response json
     * @request post
     * @param [faqid], $data
    */
    public function ajax_save_faq() {
        $params = $this->input->post();
        $faqId = isset($params['faqid']) ? $params['faqid'] : '';
        $dbParams = $this->getBoClass('faq');
        if($faqId == '') { // create new faq
            $this->Faq_Model->insertFaq($dbParams);
        }else{ // update faq
            $this->Faq_Model->updateFaq($faqId, $dbParams);
        }
        $ret = array('errorCode'=>0);
        echo json_encode($ret);
    }
    /**
     * delete faq
     * @response json
     * @request post
     * @param faqid
    */
    public function ajax_del_faq() {
        $params = $this->input->post();
        $faqId = isset($params['faqid']) ? $params['faqid'] : '';
        $this->Faq_Model->deleteFaq($faqId);
        $ret = array('errorCode'=>0);
        echo json_encode($ret);
    }
}