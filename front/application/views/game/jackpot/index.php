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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('');?>assets/user/css/game_panel.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/plugin/chart/Chart.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/user/css/pages/game/jackpot.css" />

<div class="main_container <?= $submenu!=''?'submenu_css':''; ?>"
     style="background:url('<?= base_url('');?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
<!-- START SECTION BANNER -->
<div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="display:flex; justify-content: space-around;">
		<?php
    		require_once('application/views/template/chat.php');
		?>
		<?php
    		require_once('application/views/game/jackpot/jackpot_panel.php'); 
		?>
</div>


<script type="text/javascript">
	var game_type = '<?= $data['game_type']; ?>';
	var site_url = '<?=site_url()?>';
	var base_url = '<?=base_url()?>';
	var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;
</script>

<script src="<?= base_url(''); ?>assets/vuejs/vue.min.js"></script>
<script src="<?= base_url(''); ?>assets/vuejs/axios.min.js"></script>
<script src="<?=base_url()?>assets/plugin/chart/Chart.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/user/js/pages/jackpot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
</div>
</body>
</html>
