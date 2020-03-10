<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jackpot extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('jackpot_Model', 'jackpot');
	}
	public function index() {
		$contentData['sidebar'] = true;
		$contentData['game_type'] = 'jackpot';
		$this->load_view('game/jackpot/index' , 'game' , 'jackpot' , $contentData);
	}
	public function ajax_deposit() {
		$userID = $this->session->userdata('USERID');
		if (!$userID) $this->load_json(array('status' => false, 'msg' => 'You have to login first.'));

		$this->load->model('users_Model', 'user');
		// if not logged in, then you can't ...

		$gameID = $this->input->get('game_id');
		$depositAmount = $this->input->get('deposit_amount');

		$gameInfo = $this->db->from('jackpot_game')->where('ID', $gameID)->get()->row();
		if (!$gameInfo) $this->load_json(array('status' => false, 'msg' => 'Invalid Game ID'));
		if ($gameInfo->WINNER || $this->jackpot->check_round_finishable ($gameID) ) $this->load_json(array('status' => false, 'msg' => 'Round is already finished'));

		// check if this amount is available on wallet
		$availableAmount = $this->user->available_wallet($userID);
		if ($availableAmount < $depositAmount) $this->load_json(array('status' => false, 'msg' => 'Not enough wallet.'));

		// increase block amount
		$this->user->new_bet($userID, $depositAmount);
        // update game table
        $playerExists = $this->db->select('USERID')->from('jackpot_game_log')->where('GAMEID', $gameID)->where('USERID', $userID)->get()->row();
        if (!$playerExists) {
            // if is first bet, then increase total_players
            $this->db->set('TOTAL_PLAYERS', 'TOTAL_PLAYERS +1', false);
        }
        $this->db->set('TOTAL_BETTING_AMOUNT', 'TOTAL_BETTING_AMOUNT +'.$depositAmount, false)->where('ID', $gameID)->update('jackpot_game');
		// insert into jackpot_game_log
		$this->db->insert('jackpot_game_log', 
			array(
				'USERID' => $userID,
				'GAMEID' => $gameID,
				'BET_AMOUNT' => $depositAmount,
				'CREATE_TIME' => time()
			)
		);
        $curAmount = $availableAmount - $depositAmount;
        // update session
        $this->session->set_userdata('WALLET', $curAmount);
		// notice all users in this betting game - new bet
		//	to socket server
        $host = JACKPOT_SERVER_URL."new_deposit";
		$userInfo = $this->db->from('users')->where('ID', $userID)->get()->row();
		$json = json_encode(array(
			'USERID' => $userID,
			'BET_AMOUNT' => $depositAmount,
			'GAMEID' => $gameID,
			'AVATAR' => $userInfo->AVATAR,
			'USERNAME' => $userInfo->USERNAME
		));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(    //<--- Added this code block
		        'Content-Type: application/json',
		        'Content-Length: ' . strlen($json))
		);
		$data = curl_exec($ch);
		$ret = json_decode($data , true);
		if($ret == NULL)
            $this->load_json(array('status'=> false , 'msg' => "Jackpot game server has got connection problem."));

        $this->load_json(array('status' => true, 'balance'=>number_format($curAmount, 0,'.', ' ')));
	}
	public function ajax_round_info () {
		// when a new user gets into game, first he gets current game's status
		$gameInfo = $this->jackpot->cur_game();
		//  player bet list
		$players_bet = $this->jackpot->player_bets($gameInfo->ID); // group by userid to get bets
		$game_bet = $this->jackpot->game_bets($gameInfo->ID);
        // last winner info
		$lastWinner = $this->jackpot->last_winner(); // to show last winner
		// get time left
		$gameInfo->TIME_LEFT = $this->jackpot->round_time_left($gameInfo->ID);
		// get
		if ($gameInfo->TIME_LEFT < 0) {
			$gameInfo->TIME_LEFT = 90;
			$gameInfo->STARTED = false;
		} else {
			$gameInfo->STARTED = true;
		}
		$this->load_json(array(
			'status' => true,
			// 'userid' => $myID,
			// 'deposited_amount' => $deposited_amount,
			'game' => $gameInfo,
			'bets' => $game_bet,
			'players' => $players_bet,
			'last_winner' => $lastWinner
		));
	}

	public function ajax_get_winner ($gameID) {
		$gameInfo = $this->db->from('jackpot_game')->where('ID', $gameID)->get()->row();
		if (!$gameInfo) $this->load_json(array('status' => false, 'msg' => 'Invalid Game ID'));
		if ($gameInfo->WINNER) $this->load_json(array('status' => true, 'winner' => $gameInfo->WINNER));
		$checkResult = $this->jackpot->finish_round($gameID, false);
		$this->load_json($checkResult);
	}

	public function ajax_max_amount () {
		$userID = $this->session->userdata('USERID');
		if ( !$userID ) $this->load_json( array('status' => false, 'msg' => 'You should login first.') );
		$WALLET = $this->db->from('users')->where('ID', $userID)->get()->row()->WALLET;
		$this->load_json(array('status' => true, 'wallet' => $WALLET));
	}

	public function user_info($user_id) {
		$userInfo = $this->db->from('users')->where('ID', $user_id)->get()->row();
		if (!$userInfo) $this->load_json(array('status' => false));
		$this->load_json(array('status' => true, 'user' => $userInfo));
	}
}
