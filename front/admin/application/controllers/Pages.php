<?php

class Pages extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variable_Model');
    }
    /**
     * render privacy and policy page
     * @response html
     * @request get
    */
    public function PrivacyPolicy() {
        $contentData = array();
        $info = $this->Variable_Model->getVariable('', 'privacy_policy');
        $contentData['info'] = $info;
        $this->render('pages/privacy_policy', 'Privacy and Policy', 'policy', $contentData);
    }
    /**
     * save privacy and policy
     * @response json
     * @request post
     */
    public function ajax_save_policy() {
        $params = $this->input->post();
        $content = $params['content'];
        if($this->Variable_Model->existVariable('privacy_policy')) {
            $this->Variable_Model->updateVariable('privacy_policy', $content);
        }else {
            $this->Variable_Model->insertVariable('privacy_policy', $content);
        }
        echo json_encode(array('errorCode'=>0));
    }
    /**
     * render terms and condtion page
     * @response html
     * @request get
     */
    public function Terms() {
        $contentData = array();
        $info = $this->Variable_Model->getVariable('', 'terms_conditions');
        $contentData['info'] = $info;
        $this->render('pages/terms', 'Terms and Conditions', 'terms', $contentData);
    }
    /**
     * save terms and conditions
     * @response json
     * @request post
     */
    public function ajax_save_terms() {
        $params = $this->input->post();
        $content = $params['content'];
        if($this->Variable_Model->existVariable('terms_conditions')) {
            $this->Variable_Model->updateVariable('terms_conditions', $content);
        }else {
            $this->Variable_Model->insertVariable('terms_conditions', $content);
        }
        echo json_encode(array('errorCode'=>0));
    }
}