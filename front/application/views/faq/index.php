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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('');?>assets/user/css/game_panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/css/pages/game/jackpot_responsive.css">
<link rel="stylesheet" href="<?= base_url(''); ?>assets/user/css/pages/faq.css">

<style>
	.faq-item-contents {
		color: #c1bbbb;
	}
</style>

<div class="main_container" style="background:url('<?= base_url('');?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
    <div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="display:flex; justify-content: space-around;">
        <?php
        require_once('application/views/template/chat.php');
        ?>
        <div id="main-container">
            <div class="faq-wrapper faq-panel">
                <?php for($i = 0; $i < 10; $i++) { ?>
                    <div class="faq-item-wrapper">
                        <div class="faq-item-title">
                            <label>How to play Jackpot</label>
                            <i class="fa fa-plus" onclick="openFaq(this, '<?php echo $i; ?>')"></i>
                        </div>
                        <div id="faq<?php echo $i;?>" class="faq-item-contents" style="display: none;">
                            <div class="faq-item-content">
                                <p>* Register a account on jackpot.co.za</p>
                                <p>* Register a account on jackpot.co.za</p>
                                <p>* Register a account on jackpot.co.za</p>
                            </div>
                            <div class="faq-item-link">
                                <p>https://www.youtube.com/channel/UCXUM-VATST</p>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <?php
            require_once('application/views/template/footer.php');
            ?>
        </div>
    </div>
    <!-- END SECTION BANNER -->

    <script type="text/javascript">
        var game_type = 'jackpot';
        var site_url = '<?=site_url()?>';
		var base_url = '<?=base_url()?>';
		function filter_text(str) {
			str = str.replace(/(?:\r\n|\r|\n)/g, '<br>');
			return str;
		}
		run_waitMe($('.faq-panel'), 2, 'ios');
		$.ajax({
            url: '<?= base_url("Faq/get_list") ?>',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (res) {
				$('.faq-panel').waitMe('hide');
				if(res.status != 'success') {
					showToast('error' , 'You are failed to get your deposit address.');
					return;
				}
				let html = '';
				for(let i = 0; i < res.data.length; i ++) {
					html += '<div class="faq-item-wrapper"> \
                        <div class="faq-item-title" style="cursor:pointer;" onclick="openFaq(this, ' + res.data[i].id + ')"> \
                            <label style="cursor:pointer;">' + res.data[i].question + '</label> \
                            <i class="fa fa-plus"></i> \
                        </div> \
                        <div id="faq' + res.data[i].id + '" class="faq-item-contents" style="display: none;"> \
                            ' + filter_text(res.data[i].answer) + ' \
                        </div> \
                    </div>';
				}
				$('.faq-panel').html(html);
            },
            error: function (err) {
				$('.faq-panel').waitMe('hide');
				showToast('error' , 'The network has got a problem.');
            }
        })
        function openFaq(obj, no) {
			var object = $(obj).find('i');
            if(object.hasClass('fa-plus')) {
                $("#faq" + no).slideDown();
                object.removeClass('fa-plus');
                object.addClass('fa-minus');
            }else if(object.hasClass('fa-minus')) {
                $("#faq" + no).slideUp();
                object.removeClass('fa-minus');
                object.addClass('fa-plus');
            }
        }
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
</div>

</body>
