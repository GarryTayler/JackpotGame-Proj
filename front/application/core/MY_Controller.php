<?php
class MY_Controller extends CI_Controller
{
    public $curUserno;
    public $curTime;
	public function __construct() {
        parent::__construct();
        // save last access url
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            if( !( strpos( uri_string() , 'Login' ) !== false || strpos( uri_string() , 'Signup' ) !== false ) ) {
                $this->session->set_userdata('url', current_url());
            }
        }
        if ($this->session->userdata('site_language') && $this->session->userdata('site_language') != ''){

        } else {
            $language = 'english';
            switch($language) {

                case 'english':
                    $lang = 'en';
                    break;
                case 'korean':
                    $lang = 'kr';
                    break;
                case 'chinese':
                    $lang = 'ch';
                    break;
                case 'japanese':
                	$language ='english';
                    $lang = 'en';
                    break;
            }
            $this->session->set_userdata('site_lang', $lang);
            $this->session->set_userdata('site_language', $language);
        }
        $this->load->model('Users_Model');
        if( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && !strpos( uri_string() , 'logout' ) && !strpos( uri_string() , 'signIn' ))      {
            $token = $this->Users_Model->updateToken($this->input->ip_address() , $this->session->userdata('USERID'));
            if( $token != "0" && $token != "1" ) {
                $this->session->set_userdata('token' , $token);
            }
            // update wallet in session
            $wallet = $this->db->from('users')->where('ID', $this->session->userdata('USERID'))->get()->row()->WALLET;
            $this->session->set_userdata('WALLET', $wallet);
        }

        $this->curTime = date('Y-m-d H:i:s');
	}
	public function generateReferralCode($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'REF_'.$randomString;
	}
	public function generateString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	protected function load_view($path ,  $menu = '' , $submenu = '', $contentData = NULL) {
        $data = array();
        $data['menu'] = $menu;
        $data['submenu'] = $submenu;
        if ($contentData != null) {
            $data['data'] = $contentData;
        }
        $this->load->view($path, $data);
    }

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {

        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
    function load_json( $resp ) {
        exit( json_encode( $resp ) );
    }
}
?>
