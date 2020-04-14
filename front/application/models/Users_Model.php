<?php
class Users_Model extends CI_Model {

 	public $USERS = "users";
	public $ADMIN = 'admin';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getAdminInfobyUsername( $username ) {
		$this->db->select("*");
		$this->db->from($this->ADMIN);
		$this->db->where('DEL_YN' , 'N');
		$this->db->where('USERNAME' , $username);
		$result = $this->db->get()->result_array();
		return $result;
	}

	function getUserInfobyUsername( $username ) {
		$this->db->select("*");
		$this->db->from($this->USERS);
		$this->db->where('DEL_YN' , 'N');
		$this->db->where('USERNAME' , $username);

		$result = $this->db->get()->result_array();
		return $result;
	}

	function getUserInfobyEmail( $email ) {
		$this->db->select("*");
		$this->db->from($this->USERS);
		$this->db->where('DEL_YN' , 'N');
		$this->db->where('EMAIL' , $email);

		$result = $this->db->get()->result_array();
		return $result;
	}

	function getUserInfobyUserid($userid) {
		$this->db->select("*");
		$this->db->from($this->USERS);
		$this->db->where('DEL_YN' , 'N');
		$this->db->where('ID' , $userid);
		$result = $this->db->get()->row_array();
		return $result;
	}
	function saveToken( $ipaddress , $user_id ) {
		$token = generateRandomString(TOKEN_LENGTH);
		$data = array(
			'API_TOKEN' => $token ,
			'LAST_IPADDRESS' => $ipaddress
		);
		$this->db->where('ID' , $user_id);
		$this->db->update($this->USERS , $data);
		return $token;
	}
	function updateToken( $ipaddress , $user_id ) {
		$this->db->select('*');
		$this->db->from($this->USERS);
		$this->db->where('ID' , $user_id);
		$this->db->where('DEL_YN' , 'N');
		$result = $this->db->get()->result_array();
		if(count($result) < 1)
			return "0";
		if($result[0]['API_TOKEN'] != "")
			return "1";
		return $this->saveToken( $ipaddress , $user_id );
	}
	function available_wallet($userID) {
		return $this->db->select('WALLET')->from('users')
						->where('ID', $userID)->get()->row()->WALLET;
	}
	function new_bet($userID, $betAmount) {
	    // minus user wallet
		$this->db->where('ID', $userID)
			->set('WALLET', 'WALLET - '.$betAmount, false)
			->update('users');
		// plus admin wallet
        $this->db
            ->set('WALLET', 'WALLET + '.$betAmount, false)
            ->update('admin');
	}
	function lose_game($userID, $betAmount) {
		// to do here add lose game logic
	}
	function win_game(
		$userID,
		$betAmount, // his bet amount
		$totalProfit // that game's total bet --> his total profit
	) {
		// when user wins game, he should get money from that game
		$this->db->where('ID', $userID)
			->set('WALLET', 'WALLET +' . $totalProfit, false)
			->update('users');
	}
	function bet_available($userID, $betAmount) {
		$userInfo = $this->db->from('users')->where('ID', $userID)->get()->row();
		if ( !$userInfo ) {
            return 'Invalid User ID';
		}
		if ( $userInfo->WALLET < $betAmount) {
            return 'Wallet is not enough.';
		}
		return 'success';
	}
	function saveUserInfo($userInfo) {
		$userInfo['password'] = md5($userInfo['password']);
		$userInfo['create_time'] = time();

		//var_dump($userInfo);
		//exit;

        $ret = $this->db->insert('users', $userInfo);
        return $ret;
    }
    function saveUserName($userId, $username) {
        $code = $this->db->where('ID', $userId)->set('USERNAME', $username)->update("users");
        return $code;
    }
    function saveEmail($userId, $email) {
        $code = $this->db->where('ID', $userId)->set('EMAIL', $email)->update("users");
        return $code;
    }
    function saveSecurity($userId, $password) {
	    $password = md5($password);
        $code = $this->db->where('ID', $userId)->set('PASSWORD', $password)->update("users");
        return $code;
    }
    function saveAvatar($userId, $avatar) {
        $code = $this->db->where('ID', $userId)
            ->set('AVATAR', $avatar)
            ->update("users");

        return $code;
	}
	function checkReferralCode($referralcode) {
		$this->db->select("*");
		$this->db->from($this->USERS);
		$this->db->where('DEL_YN' , 'N');
		$this->db->where('REFERRAL_CODE' , $referralcode);
		$result = $this->db->get()->result_array();
		if(count($result) < 1)
			return FALSE;
		return TRUE;
	}
}
