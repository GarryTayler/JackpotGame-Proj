<style>
.history_refresh {
	height: 44px;
	width: 44px;
	background-size: 100% 100%;
	cursor: pointer;
	background-image: url(<?=base_url()?>/assets/user/images/history.png)
}

.btn_sound {
	height: 44px;
	width: 44px;
	background-size: 100% 100%;
	cursor: pointer;
	background-image: url(<?=base_url()?>/assets/user/images/sound_on.png)
}

.btn_sound.off {
	background-image: url(<?=base_url()?>/assets/user/images/sound_off.png)
}
</style>

<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/user/css/pages/game/jackpot_responsive.css">

<div id="main-container" style="padding-top: 2px;">
    <div class="row">
        <p class="page-title">Dashboard</p>
    </div>
    <div id="top_panel" class="row">
        <div  class="row main-panel">
            <div class="bet-detail-wrapper">
                <img src="<?php echo base_url();?>assets/user/images/chance.png">
                <span class="numeric">{{my_bet.CHANCE}}%</span>
                <label>Your Wining Chances</label>
            </div>
            <div class="bet-detail-wrapper">
                <img src="<?php echo base_url();?>assets/user/images/deposit_amount.png">
                <span class="numeric">{{my_bet.BET_AMOUNT}}</span>
                <label>Your Amount</label>
            </div>
            <div class="bet-detail-wrapper">
                <img src="<?php echo base_url();?>assets/user/images/game_id.png">
                <span class="numeric">{{game.ID}}</span>
                <label>Game ID</label>
            </div>
            <div class="bet-detail-wrapper">
                <img src="<?php echo base_url();?>assets/user/images/players_in.png">
                <span class="numeric">{{players.length}}</span>
                <label>Players In</label>
            </div>
        </div>
        <div class="row icon_button_div">
            <div class="time_button_div">
                <div class="history_refresh" @click="show_history()">
                </div>
            </div>
        </div>
    </div>
    <div style="color: #d3c1d5; text-align: center;display: none;">
        <span class="title-small">Round Hash:</span><span id="round_hash">76Ed56fhhfbeeehj42dnkellzsdnkszdlfkjwe111lksdgsv23fwnmk65gdrvg29sv1</span>
    </div>
    <div class="row" style="margin-top: 20px;min-height: 550px;" id="my-panel">
        <div class="col-md-3 order-3 order-md-1">
            <div id="current_players">
                <span class="title-small" v-show="bets.length">Current Jackpot:</span>
                <div id="player_list" v-show="bets.length">
                    <div class="div-player-info row" v-for="user in bets">
                        <img src="<?php echo base_url()?>uploads/profile/<?php echo $this->session->userdata('AVATAR');?>" onerror="this.src='<?php echo base_url()?>assets/user/images/no_avatar.jpg'">
                        <div style="margin: 5px 0px; border-radius: 2px; border: solid 2px #fdb11d;"></div>
                        <div style="margin: 0px 10px;" class="bet-log-wrapper">
                            <label class="player-name">{{ user.USERNAME }}</label>
                            <div class="div-deposit-info">Deposited <span class="numeric deposit-amount">{{ user.BET_AMOUNT }}</span>
                                Coins
                            </div>
                            <label class="lbl-percent">{{ user.CHANCE }}%</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 order-1 order-md-2 ">
            <div id="jackpot_circle" style="position:relative;padding-top:100%;">
                <div id="jackpot-wrapper">
                    <div id="div-rotate">
                        <div id="div-chart">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div style="width: 100%; position: absolute;text-align: center">
                        <img style="margin: 0px auto;"
                             src="<?= base_url('assets/user/images/game/jackpot/rectangle.png') ?>">
                    </div>
                    <div class="circle_div">
                        <div id="div-relative">
                            <div class="row text_label">
                                <span id="jackpotTitle" style="margin: auto;">Jackpot</span>
                            </div>
                            <div class="row number_label" style="margin-bottom: 40px;">
                                <span id="betting_total" style="margin: auto; font-size: 48px;">${{ game.TOTAL_BETTING_AMOUNT }}</span>
                            </div>
                            <div class="row" style="padding: 0 10px;justify-content: center;align-items: center;">
                                <img src="<?= base_url('assets/user/images/game/jackpot/timer.png') ?>"
                                     class="jackpot-timer">
                                <div id="time-progress-bar">
                                    <div id="div-time-left"></div>
                                    <div id="div-time-elapsed"></div>
                                </div>
                                <span id="time_left" style="width:40px">{{formatted_time}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order-2 order-md-3 deposit-wrapper">
            <div id="winner_div">
                <div v-show="last_winner_exist">
                    <span class="title-small">Last Winner:</span>
                    <div id="last_winner" class="row">
                        <img :src="last_winner.AVATAR" class="img-winner" onerror="this.src='<?php echo base_url()?>assets/user/images/no_avatar.jpg'">
                        <div class="last-win-info" style="margin-left: 15px;flex:1">
                            <div>
                                <span id="last_winner_name">{{last_winner.USERNAME}}</span>
                            </div>
                            <table style="width:100%;font-size:14px">
                                <tr>
                                    <td id="last_win_amount">{{last_winner.BET_AMOUNT}}</td>
                                    <td id="last_win_percent">{{last_winner.WIN_CHANCE}}%</td>
                                </tr>
                                <tr style="font-size: 12px;">
                                    <td style="color:#6f7890">Won</td>
                                    <td style="color:#6f7890">Winning Chance</td>
                                </tr>
                            </table>
                        </div>
                        <img src="<?= base_url() ?>assets/user/images/win.png" class="img-win">
                    </div>
                </div>
                <div id="deposit" style="padding-top:15px;padding-right:0px;">
                    <div id="jackpotBetWrap">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                            <img src="<?= base_url('/assets/user/images/deposit_amount.png') ?>">
                            </span>
                            </div>
                            <input type="text" class="form-control"
                                   required=""
                                   v-model="input_deposit"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                   placeholder="Min Deposit is 50">
                            <div class="input-group-append" @click="on_deposit" style="cursor: pointer">
                                <span class="input-group-text">Deposit</span>
                            </div>
                        </div>
                    </div>
                    <div class="bet-btn-grid-container">
                        <div class="row">
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('+1K')" class="btn-grid-deposit">+1K</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('+10K')" class="btn-grid-deposit">+10K</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('+100K')" class="btn-grid-deposit third">+100K</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('1/2')" class="btn-grid-deposit">1/2</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('X2')" class="btn-grid-deposit">X2</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-6" style="padding: 0">
                                <div style="width: 100%; padding-top: 100%; position: relative">
                                    <button @click="on_deposit_1('MAX')" class="btn-grid-deposit">MAX</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END SECTION BANNER -->
    <?php
    require_once('application/views/template/footer.php');
    ?>

</div>
<script src="<?php echo base_url();?>assets/modules/socket.io-client/dist/socket.io.js"></script>
<script>
    var jackpot_socket = io.connect('<?php echo JACKPOT_SERVER_URL; ?>', {forceNew: true, reconnection:false});
</script>
