<!DOCTYPE html>
<html lang="en">
<?php
require_once('application/views/template/head.php');
?>

<body class="bg_light">

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

<form action="" method="POST" id="RegisterForm">
    <!-- START REGISTER WRAPPER -->
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
                <p class="login-hint">Sign up to your account here:</p>
            </div>
            <div class="text-center" style="margin-top:100px;">
                <input type="text" class="login_input" required="" name="username" id="username" placeholder="User Name"/>
            </div>
            <div class="text-center" style="margin-top:20px;">
                <input type="text" class="login_input" required="" name="email" id="email" placeholder="Email"/>
            </div>
            <div class="text-center" style="margin-top:20px;">
                <input type="password" class="login_input" required="" name="password" id="password" placeholder="Type Password"/>
            </div>
            <div class="text-center" style="margin-top:20px;">
                <input type="password" class="login_input" required="" name="confirm_password" id="confirm_password" placeholder="Confirm Password"/>
            </div>
            <div class="text-center" style="margin-top:60px;">
                <input class="custom-check" type="checkbox" id="check-privacy">
                <span class="toggle__label">
                    <span class="login-hint">I accept <a href="javascript:void(0);"><u>privacy</u></a> and <a href="javascript:void(0);"><u>policy</u></a></span>
                </span>
            </div>
            <div class="text-center" style="margin-top:60px;">
                <button type="button" class="btn_login" id="btn_register">Sign Up</button>
            </div>
        </div>
    </div>
    <!-- END REGISTER WRAPPER -->
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
<script type="text/javascript" src="<?= base_url('');?>assets/user/js/pages/register.js"></script>
</body>
</html>
