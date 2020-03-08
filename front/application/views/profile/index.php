<!DOCTYPE html>
<html lang="en">
<?php
$userInfo = $data['userInfo'];
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('');?>assets/user/css/game_panel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/user/css/pages/game/jackpot_responsive.css">
<link rel="stylesheet" href="<?= base_url(''); ?>assets/user/css/pages/profile.css">

<form action="" method="POST" id="ProfileForm" multiple="">
<div class="main_container" style="background:url('<?= base_url('');?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
    <div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="display:flex; justify-content: space-around;">
        <?php
            require_once('application/views/template/chat.php');
        ?>
        <!-- START PROFILE WRAPPER -->
        <div id="main-container" class="profile-wrapper">
            <div class="col-md-8" style="background: #1F2640;padding:50px 30px;float:left;">
                <p class="page-title" style="margin-left: 0px;">Profile</p>
                <p class="page-sub-title">Your personal information</p>
                <div class="row profile-info-wrapper">
                    <div class="col-md-6">
                        <label class="row" style="margin-left: 0px;">User name</label>
                        <input type="text" id="username" name="username" value="<?php echo $userInfo['USERNAME'];?>">
                        <button type="button" style="margin-right:10px;text-transform:none;" onclick="onSaveUsername()">Change</button>
                    </div>
                    <div class="col-md-6">
                        <label class="row" style="margin-left: 0px;">User email</label>
                        <input type="text" id="email" name="email" value="<?php echo $userInfo['EMAIL'];?>">
                        <button type="button" style="margin-right: 10px;" onclick="onSaveEmail()">Change</button>
                    </div>
                </div>
                <div class="clearfix" style="border-bottom: 2px solid #2F3753;"></div>
                <p class="profile-overview">Overview</p>
                <div class="row overview-wrapper">
                    <div class="col-md-6 left-overview">
                        <p style="color:white;">joined</p>
                        <p style="color:#547AB2;font-size:13px;"><?php echo date("Y-m-d H:i", strtotime($userInfo['UPDATE_TIME']));?></p>
                    </div>
                    <div class="col-md-6 right-overview">
                        <p style="color:white;">Deposits</p>
                        <p style="color:#547AB2;font-size:13px;"><?php echo number_format($userInfo['WALLET']);?> coins</p>
                    </div>
                    <div class="col-md-6 left-overview">
                        <p style="color:white;">joined</p>
                        <p style="color:#547AB2;font-size:13px;"><?php echo date("Y-m-d H:i", strtotime($userInfo['UPDATE_TIME']));?></p>
                    </div>
                    <div class="col-md-6 right-overview">
                        <p style="color:white;">Deposits</p>
                        <p style="color:#547AB2;font-size:13px;"><?php echo number_format($userInfo['WALLET']);?> coins</p>
                    </div>
                </div>
                <div class="clearfix" style="border-bottom: 2px solid #2F3753;"></div>
                <p class="profile-overview">Security</p>
                <div class="security-wrapper row">
                    <div class="col-md-6">
                        <p>Old Password</p>
                        <input type="password" id="old_password" name="old_password">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <p>New Password</p>
                        <input type="password" id="new_password" name="new_password">
                    </div>
                    <div class="col-md-6">
                        <p>Confirm Password</p>
                        <input type="password" id="confirm_password" name="confirm_password">
                    </div>
                </div>
                <div style="margin:0px; padding:20px 0px;">
                    <button type="button" class="btn_change" style="float: right; margin-left: 0px;" onclick="onSaveSecurityInfo()">Change</button>
                </div>
            </div>
            <div class="col-md-4 avatar-wrapper">
                <div class="text-center">
                    <img src="<?php echo base_url();?>uploads/profile/<?php echo $userInfo['AVATAR'];?>" onerror="this.src = '<?php echo base_url()?>assets/user/images/no_avatar.jpg'" id="user-avatar" style="cursor: pointer;" onclick="onChangeAvatar()">
                </div>
                <div>
                    <button type="button" class="btn_change" onclick="onSaveAvatar()">Change</button>
                </div>
                <input type="file" name="avatar_file" id="avatar_file" style="display: none;">
                <div>
                    <p>If you not setup your avatar, you'll see</p>
                    <p>default one. Upload your picture to make</p>
                    <p>avatar</p>
                </div>
            </div>
            <!-- END PROFILE WRAPPER -->
            <?php
            require_once('application/views/template/footer.php');
            ?>
        </div>
    </div>


    <script type="text/javascript">
        var game_type = 'jackpot';
        var site_url = '<?=site_url()?>';
        var base_url = '<?=base_url()?>';
        var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;
    </script>

    <script src="<?= base_url(''); ?>assets/vuejs/vue.min.js"></script>
    <script src="<?= base_url(''); ?>assets/vuejs/axios.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/user/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/profile.js"></script>
</div>
</form>
</body>
</html>
