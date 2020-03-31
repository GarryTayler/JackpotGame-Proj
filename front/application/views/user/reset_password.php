<!DOCTYPE html>
<html lang="en">
<?php
require_once('application/views/template/head.php');
?>

<style>
	body {
		background-color: #121832;
	}
</style>

<body>
<?php
require_once('application/views/template/loader.php');
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
</style>

<link rel="stylesheet" href="<?= base_url(''); ?>assets/user/css/pages/login.css">

<form action="" method="POST" id="LoginForm">
    <!-- START LOGIN WRAPPER -->
    <div class="row login-wrapper">
        <div class="col-md-6 hidden-xs hidden-sm login-left-wrapper">
            <img src="<?=base_url('');?>assets/user/images/login_bg.png" style="width: 100%;">
        </div>
        <div class="col-md-6 login-right-wrapper">
            <div class="text-center">
                <img src="<?= base_url(''); ?>assets/user/images/logo_rush.png" class="login-logo">
            </div>
            <div class="text-center">
                <p class="login-welcome">Welcome back!</p>
            </div>
            <div class="text-center">
                <p class="login-hint">Sign into your account here:</p>
            </div>
            <div class="text-center" style="margin-top:10px;">
                <input type="password" class="login_input" required="" name="password" id="password" placeholder="New Password"/>
			</div>
			<div class="text-center" style="margin-top:10px;">
                <input type="password" class="login_input" required="" name="password" id="confirm_password" placeholder="Confirm Password"/>
			</div>
			<input type="hidden" id="pass_token" value="<?= $data['pass_token'] ?>" />
            <div class="text-center" style="margin-top:50px;">
                <button class="btn_login" id="btn_login" type="button">Reset Password</button>
			</div>
            <div class="text-center" style="margin-top:80px;">
                <p class="login-hint" style="color:#F1F1F6;">Don't have an account?<a class="login-hint" href="<?= base_url('Signup'); ?>" style="color:#F1F1F6;padding-left: 10px;">Sign Up</a></p>
            </div>
        </div>
    </div>
    <!-- END LOGIN WRAPPER -->
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url(''); ?>assets/user/js/jquery.dd.min.js"></script>
<script src="<?= base_url(''); ?>assets/user/js/scripts.js"></script>
<script type="text/javascript">
    base_url = "<?= site_url(''); ?>";
</script>
<script type="text/javascript" src="<?= base_url('');?>assets/user/plugins/Atlas.Standard-master/js/blockUI.js"></script>
<script type="text/javascript" src="<?= base_url('');?>assets/user/js/global.js"></script>
<script>
	//Center the element
	$.fn.center_layout = function () {
	this.css("position", "absolute");
	this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
	this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
	return this;
	}

	//blockUI
	function blockUI() {
		$.blockUI({
			css: {
			backgroundColor: 'transparent',
			border: 'none'
			},
			message: '<div class="spinner"></div>',
			baseZ: 1500,
			overlayCSS: {
			backgroundColor: '#FFFFFF',
			opacity: 0.7,
			cursor: 'wait'
			}
		});
		$('.blockUI.blockMsg').center_layout();
	}//end Blockui
	$('#btn_login').on('click' , function(e) {
		if($('#password').val() == '') {
			showToast('error' , 'The password shouldn\'t be empty. This is required field.');
			return;
		}
		if($('#confirm_password').val() == '') {
			showToast('error' , 'Please confirm your password');
			return;
		}
		if($('#password').val() != $('#confirm_password').val()) {
			showToast('error' , 'Please confirm your password correctly.');
			return;
		}
		blockUI();
		$.ajax({
          url: base_url+'User/submit_password',
          type: 'POST',
          dataType: 'json',
          data: {
			password: $('#password').val(),
			pass_token: $('#pass_token').val()
          },
          success: function(data) {
              $.unblockUI();
			  //console.log(data);
			  if(data.status == "success") {
				showToast('success' ,'The password was reset successfully.');
			  }
			  else {
				showToast('error' , 'The password reset was just failed.');
			  }
          }
        });
	});
</script>
</body>
</html>
