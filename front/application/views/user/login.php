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
            <div class="text-center" style="margin-top:80px;">
                <input type="text" class="login_input" required="" name="username" id="username" placeholder="Email"/>
            </div>
            <div class="text-center" style="margin-top:10px;">
                <input type="password" class="login_input" required="" name="password" id="password" placeholder="Password"/>
            </div>
            <div class="text-center">
                <p style="margin-top:20px;cursor: pointer;" class="login-hint"><a class="login-hint" href="javascript:void(0);">FORGOT PASSWORD ?</a></p>
            </div>
            <div class="text-center" style="margin-top:50px;">
                <button class="btn_login" id="btn_login" type="button">Login to your account</button>
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
<script type="text/javascript" src="<?= base_url('');?>assets/user/js/pages/login.js"></script>
</body>
</html>
