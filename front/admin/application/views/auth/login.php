<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Login | SPIN2WIN</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>">
<!-- Bootstrap Core CSS -->
<link href="<?=base_url('assets/plugin/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
<!-- animation CSS -->
<link href="<?=base_url('assets/elvis/css/animate.css')?>" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?=base_url('assets/elvis/css/style.css')?>" rel="stylesheet">
<!-- color CSS -->
<link href="<?=base_url('assets/elvis/css/colors/default-dark.css')?>" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
    var site_url = '<?=site_url()?>';
</script>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="index.html">
        <h3 class="box-title m-b-20">Sign In</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" name="username" type="text" required="" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="password" type="password" required="" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Remember me </label>
            </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
        <div class="form-group m-b-0 hide">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="<?=site_url()?>register" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="<?=base_url('assets/plugin/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url('assets/plugin/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?=base_url('assets/plugin/sidebar-nav/dist/sidebar-nav.min.js')?>"></script>

<!--slimscroll JavaScript -->
<script src="<?=base_url('assets/js/jquery.slimscroll.js')?>"></script>
<!--Wave Effects -->
<script src="<?=base_url('assets/js/waves.js')?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?=base_url('assets/js/custom.min.js')?>"></script>
<!--Style Switcher -->
<script src="<?=base_url('assets/plugin/styleswitcher/jQuery.style.switcher.js')?>"></script>
<script src="<?=base_url('assets/js/login.js')?>"></script>
</body>
</html>
