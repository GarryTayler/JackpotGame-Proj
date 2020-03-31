<?php

class MY_Controller extends CI_Controller {
    public $user_data;
    public $custom_js = array();
    public $custom_css = array();


    function __construct()
    {
        parent::__construct();

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in) {
            $this->user_data = $this->session->userdata();
        } else {
            $controller = $this->uri->rsegment(1);
            if ($controller != 'auth') {
                redirect('login');
            }
        }
    }

    /**====  start my custom function =====*/
    protected function isParam($key) {
        $gVal = $_GET[$key];
        if (!isset($gVal)) {
            $pVal = $_POST[$key];
            if (!isset($pVal)) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    protected function getParam($key, $def) {
        if (!isset($_REQUEST[$key])) {
            return $def;
        }
        return trim($_REQUEST[$key]);
    }

    protected function convertKeyStringFromDBToJava($keyName){
        $array = explode("_",$keyName);
        $keyName = $array[0];
        for($i = 1 ; $i< count($array) ; $i++){
            $eleStr = $array[$i];
            $eleStr = strtoupper(substr($eleStr, 0,1)).substr($eleStr,1);
            $keyName .= $eleStr;
        }
        return $keyName;
    }

    protected function getBoClass($tableName) {
        $sql = "SHOW COLUMNS FROM " . $tableName;
        $result = $this->db->query($sql);
        file_put_contents("1.txt", print_r($result, 1));
        $data = array();
        foreach ($result as $item) {
            if ($this->isParam($this->convertKeyStringFromDBToJava($item['Field'])) ) {
                $inputValue = $this->getParam($this->convertKeyStringFromDBToJava($item['Field']), $item['Default']);
                if ($item['Key'] == 'PRI') {
                    if ($inputValue != "") {
                        $data[$item['Field']] = $inputValue;
                    }
                } else {
                    //if ($inputValue != '') {
                    $data[$item['Field']] = $inputValue;
                    //}
                }
            }else if($this -> isParam($item['Field'])){
                $inputValue = $this->getParam($item['Field'], $item['Default']);
                if ($item['Key'] == 'PRI') {
                    if ($inputValue != "") {
                        $data[$item['Field']] = $inputValue;
                    }
                } else {
                    //if ($inputValue != '') {
                    $data[$item['Field']] = $inputValue;
                    //}
                }
            }
        }
        return $data;
    }

    /**====  end my custom function =====*/

    public function render($path, $title, $menu, $data = array()) {
        $data_ = array(
            'content_path' => $path,
            'content_data' => $data,
            'cur_menu' => $menu,
            'title' => $title
        );
        $data_['menus'] = array(
            array('title' => 'Dashboard', 'icon' => 'flaticon-layers', 'id' => 'dashboard', 'path' => 'dashboard'),
            array('title' => 'User', 'icon' => 'la la-users', 'id' => 'users', 'path' => 'user'),
            array('title' => 'GameHistory', 'icon' => 'flaticon-layers', 'id' => 'jackpot', 'path' => 'Game/Jackpot'),
            array('title' => 'Wallet', 'icon' => 'la la-money', 'has_submenu' => true,
                'id' => array('deposit', 'withdrawal'),
                'submenus' => array(
                    array('title' => 'Deposit', 'path' => 'Wallet/Deposit', 'id' => 'Deposit'),
                    array('title' => 'Withdraw', 'path' => 'Wallet/Withdraw', 'id' => 'Withdrawal'),
                )
            ),
            array('title' => 'Referral', 'icon' => 'la la-gift', 'has_submenu' => true,
                'id' => array('referral'),
                'submenus' => array(
                    array('title' => 'Referral', 'path' => 'referral', 'id' => 'referral'),
                )
            ),
            array('title' => 'Setting', 'icon' => 'la la-cog', 'id' => 'referral_setting', 'path' => 'referral/setting'),
            array('title' => 'Pages', 'icon' => 'la la-suitcase', 'has_submenu' => true,
                'id' => array('faq', 'policy', 'terms'),
                'submenus' => array(
                    array('title' => 'Faq', 'path' => 'faq', 'id' => 'faq'),
                    array('title' => 'Privacy and Policy', 'path' => 'Pages/PrivacyPolicy', 'id' => 'policy'),
                    array('title' => 'Terms and Conditions', 'path' => 'Pages/Terms', 'id' => 'terms'),
                )
            ),
        );
        $this->load->view('layout/index', $data_);
    }

    protected function load_table($page, $perpage, $total, $data) {
        // response to datatable
        if (!$perpage) $perpage = 1; // exception for perpage = 0
        echo json_encode(array(
            'meta' => array(
                'page' => $page,
                'pages' => ceil($total / $perpage),
                'perpage' => $perpage,
                'total' => $total
            ),
            'data' => $data
        ));
    }

    protected function load_json($status, $data) {
        $data['status'] = $status;
        exit(json_encode($data));
    }

    protected function res_success($msg = '', $data = array()) {
        $data['msg'] = $msg;
        $this->load_json(true, $data);
    }

    protected function res_error($msg, $error = '', $data = array()) {
        $data['msg'] = $msg;
        $data['error'] = $error;
        $this->load_json(false, $data);
    }

    protected function load_datatable() {
        $this->custom_css[] = 'assets/plugins/datatables/datatables.min.css';
        $this->custom_css[] = 'assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css';
        $this->custom_css[] = 'assets/plugins/boostrap/css/bootstrap.min.css';
        // $this->custom_js[] = 'assets/plugins/bootstrap/js/bootstrap.min.js';
        $this->custom_js[] = 'assets/plugins/jquery.blockui.min.js';
        $this->custom_js[] = 'assets/plugins/datatables/datatable.min.js';
        $this->custom_js[] = 'assets/plugins/datatables/datatables.min.js';
        $this->custom_js[] = 'assets/plugins/app.min.js';
        $this->custom_js[] = 'assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js';

    }
}
