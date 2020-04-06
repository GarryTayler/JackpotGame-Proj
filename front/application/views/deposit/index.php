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

    ::-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: #fff;
    }
    ::-ms-input-placeholder { /* Microsoft Edge */
        color: #fff;
	}
	.btn_change:hover {
		background-color: #2c51bd;
	}
	#qrcode {
		width: 140px;
		height: 140px;
		margin: 0 auto;
		text-align: center;
		background: #fff;
    	padding: 6px;
	}
	#qrcode a {
		font-size: 0.8em;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('');?>assets/user/css/game_panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/css/pages/game/jackpot_responsive.css">
<link rel="stylesheet" href="<?= base_url(''); ?>assets/user/css/pages/deposit.css">

<div class="main_container" style="background:url('<?= base_url('');?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
    <div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="display:flex; justify-content: space-around;">
        <?php
        require_once('application/views/template/chat.php');
        ?>
        <div id="main-container" class="deposit-wrapper">
            <div class="row deposit-panel" style="margin-left: 0px; margin-right: 0px;">
                <div class="col-md-8 deposit-info-wrapper" style="background: #1F2640;float:left;">
                    <p class="text-center" style="color:#C8CAD0;font-size:13px;">You will receive coins automatically after sending BTC to the address displayed below</p>
					<p class="text-center" style="color:#C8CAD0;font-size:13px;">You have to deposit at least 0.00012BTC. Spin2Win won't proceed with deposit processing for any amount below that.</p>
                    <div class="text-center">
                        <div class="address-wrapper">
                            <p style="text-align: left;font-size: 13px;width:100%;">Your personal BTC deposit address</p>
                            <input type="text" id="deposit-address" name="deposit-address" readonly>
                            <button class="btn_change" id="copy_address">Copy address</button>
                        </div>
                        <div class="qr-wrapper">
                           <!--
							   <img src="<?php echo base_url()?>assets/user/images/qr_image.png">
							-->
							<div id="qrcode"></div>
                        </div>
                        <div class="calc-wrapper">
                            <p>COIN TO BTC CALCULATOR</p>
                            <input type="text" id="coin_value" name="coin_value">
                            <span>Coin</span>
                            <label>=</label>
                            <input type="text" id="btc_value" name="btc_value">
                            <span>BTC</span>
                        </div>
                        <div class="pay-wrapper">
                            <p>Payement Via</p>
                            <a href="#"><img src="<?php echo base_url()?>assets/user/images/bitcoin.png"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bitcoin-deposit-wrapper">
                    <p class="wrapper-header">Deposit With</p>
                    <p class="wrapper-header">Bitcoin</p>
                    <a href="#"><img src="<?php echo base_url()?>assets/user/images/bit_coin_depost.png"></a>
                </div>
            </div>
            <!-- END SECTION BANNER -->
            <?php
            require_once('application/views/template/footer.php');
            ?>
        </div>
    </div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script type="text/javascript">
		var game_type = 'jackpot';
		var coin = 0 , btc = 0;
        var site_url = '<?=site_url()?>';
        var base_url = '<?=base_url()?>';
		var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;
		run_waitMe($('.deposit-panel'), 2, 'ios');
		$.ajax({
            url: '<?= base_url("Deposit/getWalletAddress") ?>',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (res) {
				$('.deposit-panel').waitMe('hide');
				if(res.status != 'success') {
					showToast('error' , 'You are failed to get your deposit address.');
					return;
				}
				$('#deposit-address').val(res.data.res);
				$('#qrcode').empty();
				$('#qrcode').qrcode({width: 128,height: 128,text: res.data.res});
            },
            error: function (err) {
				$('.deposit-panel').waitMe('hide');
				showToast('error' , 'The network has got a problem.');
            }
        })
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
		$('#copy_address').on('click', function(e) {
			var copyText = document.getElementById("deposit-address");
			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /*For mobile devices*/
			 /* Copy the text inside the text field */
			  document.execCommand("copy");
			  showToast('success' , 'The deposit address is copied.');
		});
	</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
</div>
</body>
</html>
