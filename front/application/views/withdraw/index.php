<!DOCTYPE html>
<html lang="en">
<?php
require_once('application/views/template/head.php');
?>

<body class="bg_light">

<?php
require_once('application/views/template/loader.php');
?>

<?php
require_once('application/views/template/menu.php');
?>

<style>
    input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #fff;
    }

    textarea::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #bfb9cc;
    }

    ::-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: #fff;
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
        color: #fff;
    }
</style>

<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>assets/user/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>assets/user/css/game_panel.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugin/chart/Chart.min.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/user/css/pages/game/jackpot.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/user/css/pages/game/jackpot_responsive.css">
<div class="main_container <?= $submenu != '' ? 'submenu_css' : ''; ?>"
     style="background:url('<?= base_url(''); ?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
    <!-- START SECTION BANNER -->
    <div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s"
         style="display:flex; justify-content: space-around;">
        <?php
        require_once('application/views/template/chat.php');
        ?>
        <div id="main-container">
            <div id="referralPanelWrap">
                <div class="referralBox">
                    <p style="margin-bottom: 0;margin-top: 15px;line-height: 1.1;padding:10px;">You can send withdraw request with your address and amount.</p>
                    <p>Each request will take transaction fees</p>
                    <div class="withdraw-from-wrapper">
                            <div class="form-group">
                                <label class="control-label">Your personal BTC withdraw address</label>
                                <input type="text" id="withdraw_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Amount</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="coin_value" name="coin_value">
                                    <div class="input-group-append">
                                        <span class="input-group-text wdPlaceholder">Coin</span>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="wdEqualSign">=</span>
                                    </div>
                                    <input type="text" class="form-control" id="btc_value" name="btc_value">
                                    <div class="input-group-append">
                                        <span class="input-group-text wdPlaceholder">BTC</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tx Fee 0 BTC</label>
                            </div>
                            <div class="form-group text-center">
                                <button class="wd-btn" id="request_withdrawal">Request Withdrawal</button>
                            </div>
                    </div>
                </div>
                <div class="howItWorksWrap withdraw">
                    <h2 class="withdraw-title">Withdraw <br>Bitcoin</h2>
                    <div id="withdrawBitcoinInfo">
                        <span>Available BTC Balance</span>
                        <table style="width:100%">
                            <tr style="color:white">
                                <td id="btcTd"><?= $data['available_wallet_btc'] ?></td>
                                <td id="coinsTd"><?= $data['available_wallet_coin'] ?></td>
                            </tr>
                            <tr>
                                <td >BTC</td>
                                <td>Coins</td>
                            </tr>
                        </table>
                    </div>
                    <img src="<?= base_url("assets/user/images/withdraw_bg.png"); ?>" class="wd-info-bg">
                </div>
            </div>
            <!-- END SECTION BANNER -->
            <?php
            require_once('application/views/template/footer.php');
            ?>
        </div>
    </div>

    <script type="text/javascript">
        var game_type = '<?= $data['game_type']; ?>';
        var site_url = '<?=site_url()?>';
        var base_url = '<?=base_url()?>';
		var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;
		var coin = 0 , btc = 0;
		$('#coin_value').on('keyup' , function(e) {
			coin = parseFloat($('#coin_value').val());
			if(isNaN(coin)) {
				btc = 0;
			}
			else
				btc = parseFloat(coin / 1000000).toFixed(6);
			$('#btc_value').val(btc);
		});
		$('#btc_value').on('keyup' , function(e) {
			btc = parseFloat($('#btc_value').val());
			if(isNaN(btc))
				coin = 0;
			else
				coin = parseInt(btc * 1000000);
			$('#coin_value').val(coin);
		});
		$('#request_withdrawal').on('click' , function(e) {
			if($('#withdraw_address').val() == '') {
				showToast('error' , 'You should fill your personal withdraw address');
				return;
			}
			if(coin == 0 || btc == 0) {
				showToast('error' , 'You should fill your withdrawal amount');
				return;
			}
			run_waitMe($('#main-container'), 2, 'ios');
			$.ajax({
				url: '<?= base_url("Withdraw/withdrawRequest") ?>',
				type: 'post',
				dataType: 'json',
				data: {
					"to_address": $('#withdraw_address').val(),
					"amount": btc
				},
				success: function (res) {
					$('#main-container').waitMe('hide');
					if(res.status != 'success') {
						showToast('error' , 'You are failed to request withdraw.');
						return;
					}
					showToast('success' , 'You did withdrawal request successfully.');
					btc = 0; coin = 0;
					$('#withdraw_address').val('');
					$('#btc_value').val('');
					$('#coin_value').val('');
				},
				error: function (err) {
					$('#main-container').waitMe('hide');
					showToast('error' , 'The network has got a problem.');
				}
			})

		})
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript"
            src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>

</div>
</body>
</html>
