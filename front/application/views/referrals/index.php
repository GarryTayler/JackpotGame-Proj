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
        <div id="main-container" >
            <div id="referralPanelWrap">
                <div class="referralBox">
                    <h3>Referral</h3>
                    <p>Invite your friends and win money</p>
                    <div class="referral-from-wrapper">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Your referral link</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text" id="yourReferralLink">Copy</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Your referral code</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text" id="yourReferralCode">Change</span>
                                    </div>
                                </div>
                            </div>
                            <p style="max-width: 80%;margin: 0 auto;">New user will get <strong>+5%</strong> bonus on their first deposit for using your code</p>
                        </form>
                    </div>
                </div>
                <div class="howItWorksWrap">
                    <h3>How it works?</h3>
                    <div class="howItWorksItem">
                        <img src="<?= base_url('assets/user/images/referral_step_1.png'); ?>">
                        <div>
                            <h4>1. Share your referral link or code</h4>
                            <p>Everyone who registers through your link or uses your code becomes your referral.</p>
                            <p>The Code will give your referrals + 5% on their first deposit.</p>
                        </div>
                    </div>
                    <div class="howItWorksItem arrow-img">
                        <img src="<?= base_url('assets/user/images/referral_arrow_down_1.png'); ?>">
                        <div></div>
                    </div>
                    <div class="howItWorksItem">
                        <img src="<?= base_url('assets/user/images/referral_step_2.png'); ?>">
                        <div>
                            <h4>2. Earn Money and Rank Points</h4>
                            <p>You will get up to 40 % of our revenue(House Edge) from bets placed by our referrals and
                                Rank Points equal to their first deposit.</p>
                        </div>
                    </div>
                    <div class="howItWorksItem arrow-img">
                        <img src="<?= base_url('assets/user/images/referral_arrow_down_2.png'); ?>">
                        <div></div>
                    </div>
                    <div class="howItWorksItem">
                        <img src="<?= base_url('assets/user/images/referral_step_3.png'); ?>">
                        <div>
                            <h4>3. use earned money for betting or withdrawal</h4>
                            <p>Simple, isn' it? If you need any help contact our support.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SECTION BANNER -->
            <?php
            require_once('application/views/template/footer.php');
            ?>
        </div>
    </div>



    <script type="text/javascript">
        var game_type = 'jackpot';;
        var site_url = '<?=site_url()?>';
        var base_url = '<?=base_url()?>';
        var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript"
            src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>

</div>
</body>
</html>
