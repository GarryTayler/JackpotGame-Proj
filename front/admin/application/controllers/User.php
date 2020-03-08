<?php

class User extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_Model');
    }
    /**
     * render user index page
     * @response html
     * @request get
     * @param void
    */
    public function index() {
        $totalCount =$this->Users_Model->getUsersCount();
        $pageParams = array(
            'page'=>1,
            'pageSize'=>10,
            'totalCount' =>$totalCount
        );
        $this->render('user/index', 'Users', 'users', $pageParams);
    }
    /**
     * render user create page
     * @response html
     * @request get
     * @param void
    */
    public function create() {
        $data = array();
        $this->render('user/create', 'Create User', 'users', $data);
    }
    /**
     * render user edit page
     * @response html
     * @request get
     * @param userid
     */
    public function reset_password() {
        $params = $this->input->get();
        $userId = isset($params['userid']) ? $params['userid'] : '';
        // if user id is empty, then go to error page

        // get user information by userid
        $userInfo = $this->Users_Model->getUser($userId);
        $data = array(
            'userInfo' => $userInfo
        );
        $this->render('user/edit', 'Edit User', 'users', $data);
    }
    /**
     * save user information
     * @response json
     * @request post
     * @param user form data
    */
    public function ajax_save_user() {
        $params = $this->input->post();
        $dbParams = $this->getBoClass('users');
        $id = isset($params['id']) ? $params['id'] : '';
        $ret = array();
        if($id == '') { // create new user
            $this->Users_Model->insertUser($dbParams);
            $ret['errorCode'] = 0;
            $ret['link'] = '/User';
        }else { // reset password
            // check this id is exist in db
            if(!$this->Users_Model->existUser($id)) {
                $ret['errorCode'] = 1;
                $ret['msg'] = 'The user is not exist.';
            }else {
                // check old password
                $userInfo = $this->Users_Model->getUser($id);
                if($userInfo['PASSWORD'] != $params['old_password']) {
                    $ret['errorCode'] = 1;
                    $ret['msg'] = 'The password is incorrect.Please check the password.';
                }else {
                    $dbParams['PASSWORD'] = $params['new_password'];
                    $this->Users_Model->saveUser($dbParams);
                    $ret['errorCode'] = 0;
                    $ret['link'] = '/User';
                }
            }
        }
        echo json_encode($ret);
    }

    /**
     * delete user
     * @response json
     * @request post
     * @param user id
    */
    public function ajax_delete_user() {
        $params = $this->input->post();
        $id = isset($params['userid']) ? $params['userid'] : '';
        $ret = array();
        if($id == '') {
            $ret['errorCode'] = 1;
            $ret['msg'] = 'Invalid User ID';
        }else {
            $this->Users_Model->deleteUser($id);
            $ret['errorCode'] = 0;
        }
        echo json_encode($ret);
    }
    /**
     * Block/UnBlock User
     * @response json
     * @request post
     * @param user id
     */
    public function ajax_block_user()
    {
        $id = $this->getParam('userid', '');
        $ret = array();
        if ($id == '') {
            $ret['errorCode'] = 1;
            $ret['msg'] = 'Invalid User ID';
        } else {
            $isExistUser = $this->Users_Model->existUser($id);
            if (!$isExistUser) {
                $ret['errorCode'] = 1;
                $ret['msg'] = "Can't find user information";
            } else {
                $userInfo = $this->Users_Model->getUser($id);
                if ($userInfo['STATE'] * 1 == 0 ) {
                    $this->Users_Model->updateUser($id, array('STATE' => 1));
                } else {
                    $this->Users_Model->updateUser($id, array('STATE' => 0));
                }
                $ret['errorCode'] = 0;
            }
        }
        echo json_encode($ret);
    }

    public function ajax_reset_password() {
        $id = $this->getParam('userid', '');
        $ret = array();
        if ($id == '') {
            $ret['errorCode'] = 1;
            $ret['msg'] = 'Invalid User ID';
        } else {
            $isExistUser = $this->Users_Model->existUser($id);
            if (!$isExistUser) {
                $ret['errorCode'] = 1;
                $ret['msg'] = "Can't find user information";
            } else {
                $password = $this->config->item('default_password');
                $this->Users_Model->updateUser($id, array('PASSWORD' => md5($password)));
                $ret['errorCode'] = 0;
            }
        }
        echo json_encode($ret);
    }

    /**
     * get user list by ajax request
     * @response json
     * @request post
     * @param [page], [pageSize], [searchValue], [orderby], [direction]
    */
    public function ajax_get_users() {
        $params = $this->input->post();
        // pagination parameters
        $page = isset($params['page']) ? $params['page'] : 1;
        $page = ($page == '') ? 1 : $page;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        // search parameters
        $searchValue = isset($params['searchValue']) ? $params['searchValue'] : '';
        // order parameters
        $orderby = isset($params['orderby']) ? $params['orderby'] : '';
        $direction = isset($params['direction']) ? $params['direction'] : '';
        // get total count of users
        $totalCount = $this->Users_Model->getUsersCount($searchValue);
        // get user list
        $userList = $this->Users_Model->getUsers($searchValue, $page, $pageSize,$orderby, $direction);
        $ret = array('totalCount'=>$totalCount, 'userList'=>$userList);
        echo json_encode($ret);
    }
}