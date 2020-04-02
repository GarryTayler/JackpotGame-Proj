<?php

class Jackpot_Model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->model('Variable_Model', 'variable');
        $this->load->helper('string');
    }

    function cur_game () {
        // return last game status

        $curGame = $this->db->from('jackpot_game')->order_by('ID', 'desc')->limit(1)->get()->row();
        if (!$curGame || $curGame->WINNER) {
            // no game round exists or winner is set --> means already finished
            return $this->new_round();
        }

        // if last game is not finished but time past enough then finish it
        $checkResult = $this->finish_round($curGame->ID);
        if ($checkResult['status']) {
            // means round is finished, then create new
            return $this->new_round();
        } else {
            return $curGame;
        }
    }

    function finish_round ( $gameID ) {
        // check if there's more than two bets
        $players_bet = $this->db->from('jackpot_game_log')->where('GAMEID', $gameID)->select('USERID')->distinct()->count_all_results();
        if ($players_bet < 2) return array('status' => false, 'msg' => 'Not enough bets');
        // check if time past
        // get the first 2 bet time from jackpot_game_log

        // we get winner
        $gameInfo = $this->db->from('jackpot_game')->where('ID', $gameID)->get()->row();
        if ($gameInfo->WINNER) {
            // winner is already set ?
            return array('status' => true, 'winner' => $gameInfo->WINNER);
        }

        $timeLeft = $this->round_time_left($gameID);
        if ($timeLeft != 0) {
            return array('status' => false, 'msg' => 'Time still left');
        }

        // this is the most important part here !!!
        $win_value = rand(0, $gameInfo->TOTAL_BETTING_AMOUNT); // REPLACE THIS FUNC TO GET REAL WINNER

        $gameLogs = $this->db->from('jackpot_game_log')->where('GAMEID', $gameID)->order_by('ID')->get()->result();
        $curValue = 0;
        $winner = 0;
        foreach ($gameLogs as $betInfo) {
            $prevValue = $curValue;
            $curValue += $betInfo->BET_AMOUNT;
            if ($win_value >= $prevValue && $win_value <= $curValue) {
                // winnner
                $winner = $betInfo;
                break;
            }
        }
        // set winner to game
        $this->db->update('jackpot_game', array('WINNER' => $winner->USERID), array('ID' => $gameID));
        // HERE SERVER SIDE GET'S THERE PROFIT; hmm ~
        $this->load->model('users_model', 'user');
        // update user's wallets
        $bets = $this->game_bets($gameID);
        // loser get's nothing
        $winner_bet = 0;
        foreach ($bets as $player) {
            if ($player->USERID == $winner->USERID) {
                $winner_bet += $player->BET_AMOUNT;
                continue;
            }
            $this->user->lose_game($player->USERID, $player->BET_AMOUNT);
            // when user loses bet, PROFIT is minus
            $loss_profit = "-".$player->BET_AMOUNT;
            $this->db->from('jackpot_game_log')
                ->where('GAMEID', $gameID)
                ->where('USERID', $player->USERID)
                ->set('PROFIT', $loss_profit)
                ->update();
        }


        // server profit
	    //Get betting server profit from variable table
        $server_betting_profit = 0;
        $adminFeeInfo = $this->getVariable("", 'ADMIN_FEE');
        if (isset($adminFeeInfo['VALUE'])) {
            $server_betting_profit = $adminFeeInfo['VALUE'];
        } else {
            $server_betting_profit = BETTING_SERVER_PROFIT;
        }
        $server_profit = ($gameInfo->TOTAL_BETTING_AMOUNT - $winner_bet) * $server_betting_profit / 100;
        $this->db->update('jackpot_game', array('TOTAL_PROFIT' => $server_profit), array('ID' => $gameID));
        // winner profit
        $winner_profit = $gameInfo->TOTAL_BETTING_AMOUNT - $server_profit;
        $this->db->from('jackpot_game_log')
            ->where('GAMEID', $gameID)
            ->where('USERID', $winner->USERID)
            ->set('PROFIT', $winner_profit)
            ->update();

        // minus winner profit from admin wallet
        $this->db
            ->set('WALLET', 'WALLET - '.$winner_profit, false)
            ->update('admin');
        // plus winner profit to winner wallet
        $this->user->win_game($winner->USERID, $winner_bet, $winner_profit);
        return array('status' => true, 'winner' => $winner->USERID);
    }

    function new_round() {
        // creates new round
		$this->db->insert('jackpot_game', array(
			'CREATE_TIME' => time(),
			'UPDATE_TIME' => time(),
			'HASH' => md5(random_string()) // we need to change this ...
        ));
        $gameInfo = $this->db->from('jackpot_game')->where('ID', $this->db->insert_id())->get()->row();
        return $gameInfo;
	}
	
	function player_bets($gameID) {
		$result = $this->db->from('jackpot_game_log G')->where('GAMEID', $gameID)
        ->select('USERID, sum(BET_AMOUNT) BET_AMOUNT')
        ->join('users U', 'U.ID = G.USERID')
        ->select('U.USERNAME, U.AVATAR')
        ->group_by('USERID , G.GAMEID')->order_by('G.ID', 'desc')->get()->result();
		return $result;
	}

    function game_bets($gameID) {
        return $this->db->from('jackpot_game_log G')->where('GAMEID', $gameID)
        ->select('USERID, BET_AMOUNT')
        ->join('users U', 'U.ID = G.USERID')
        ->select('U.USERNAME, U.AVATAR')
        ->order_by('G.ID', 'desc')->get()->result();
    }

    function last_winner() {
        $lastFinishedRound = $this->db->from('jackpot_game')->where('WINNER >', 0)->order_by('ID', 'desc')->limit(1)->get()->row();
        if (!$lastFinishedRound) {
            return false;
        }
        $lastWinner = $this->db->from('users')->where('ID', $lastFinishedRound->WINNER)
                    ->select('ID, USERNAME, AVATAR')
                    ->get()->row();
        $winnerBetInfo = $this->db->from('jackpot_game_log')->where('GAMEID', $lastFinishedRound->ID)->where('USERID', $lastWinner->ID)->select('sum(BET_AMOUNT) BET_AMOUNT')->get()->row();

        $lastWinner->BET_AMOUNT = $winnerBetInfo->BET_AMOUNT;
        $lastWinner->WIN_CHANCE = number_format($winnerBetInfo->BET_AMOUNT / $lastFinishedRound->TOTAL_BETTING_AMOUNT * 100, 2);

        return $lastWinner;
    }

    function check_round_finishable ($gameID) {
        // we don't check 
        $checkResult = $this->finish_round ($gameID);
        return $checkResult['status'];
    }

    function round_time_left($gameID) {
        // get the second bet info (i mean second user) and that bet time
        $firstBetUser = $this->db->from('jackpot_game_log')->where('GAMEID', $gameID)->select('USERID')->order_by('ID')->limit(1)->get()->row();
        if (!$firstBetUser) return -1; // waiting for first bet
        $secondBetUser = $this->db->from('jackpot_game_log')->where('GAMEID', $gameID)->where('USERID !=', $firstBetUser->USERID)->order_by('ID')->limit(1)->get()->row();
        if (!$secondBetUser) return -1; // waiting for second bet

        $timeLeft = $secondBetUser->CREATE_TIME + 90 - time();

        if ($timeLeft < 0) return 0;
        return $timeLeft;
    }

    /**
     * get variable by id or key
     * @return mixed
     * @param $id or $key
     * */
    function getVariable($id = '', $key = '') {
        if($id != '') {
            $ret = $this->db
                ->from('variable')
                ->where('ID', $id)
                ->get()
                ->row_array();
            return $ret;
        }else if($key != '') {
            $ret = $this->db
                ->from('variable')
                ->where('VARIABLE', $key)
                ->get()
                ->row_array();
            return $ret;
        }else{
            return false;
        }
    }
}
