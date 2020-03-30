<?php

class Auth extends MY_Controller {
    function __construct() {
        parent::__construct();

        $method = $this->uri->rsegment(2);
        if (!$this->user_data) {
            // change password, ajax_set_password is not available for not logged in user
            if ($method == 'change_password') {
                redirect('login');
            } else if ($method == 'ajax_set_password') {
                $this->res_error('You are not logged in');
            }
        }
    }

    public function login() {
        if ($this->user_data && $this->user_data['user_role'] == 'ADMIN') {
            redirect('proxy');
        }
        $this->load->view('auth/login');
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function ajax_login() {
        $data = $this->input->post();
        $admin = $this->db->from('admin')->where('USERNAME', $data['username'])->where('PASSWORD', md5($data['password']))->get()->row_array();
        if (!$admin) {
            $this->res_error('Invalid username or password');
        }

        $admin['logged_in'] = true;
        $this->session->set_userdata($admin);
        $this->res_success();
    }

    public function ajax_register() {
        $data = $this->input->post();
        //check for duplicate
        $dupExist = $this->db->from('users')->where('deleted', 0)->where('user_email', $data['user_email'])->get()->row();
        if ($dupExist) {
            $this->res_error('Email already registered.');
        }

        $this->my_model->_save('users', array(
            'user_name' => $data['user_name'],
            'user_email' => $data['user_email'],
            'user_password' => md5($data['user_password'])
        ));

        $this->res_success();
    }

    // change password content
    public function change_password() {
        $this->render('auth/change_password', 'Change Password', 'change_password');
    }

    public function ajax_set_password() {
        $data = $this->input->post();
        // check for cur password
        $password = $this->db->from('admin')->where('ID', $this->user_data['ID'])->get()->row()->PASSWORD;
        if ($password != md5($data['curPassword'])) {
            $this->res_error('Current password doesn\'t match.');
        }
        $this->db->update('admin', array('PASSWORD' => md5($data['password'])), array('ID' => $this->user_data['ID']));

        $this->res_success();
    }
}
