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


<div class="main_container" style="background:url('<?= base_url('');?>assets/user/images/background.png') no-repeat center 0; padding-top: 100px !important;">
    <div class="game_panel animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="display:flex; justify-content: space-around;">
        <?php
        require_once('application/views/template/chat.php');
        ?>
        <div id="main-container">
            <div class="faq-wrapper">
                <?php for($i = 0; $i < 10; $i++) { ?>
                    <div class="faq-item-wrapper">
                        <div class="faq-item-title">
                            <label>How to play Jackpot</label>
                            <i class="fa fa-plus" onclick="openFaq(this, '<?php echo $i; ?>')"></i>
                        </div>
                        <div id="faq<?php echo $i;?>" style="display: none;">
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
        var user_id = <?=or_default($this->session->userdata('USERID'), 0)?>;

        function openFaq(obj, no) {
            if($(obj).hasClass('fa-plus')) {
                $("#faq" + no).slideDown();
                $(obj).removeClass('fa-plus');
                $(obj).addClass('fa-minus');
            }else if($(obj).hasClass('fa-minus')) {
                $("#faq" + no).slideUp();
                $(obj).removeClass('fa-minus');
                $(obj).addClass('fa-plus');
            }
        }
    </script>

    <script src="<?= base_url(''); ?>assets/vuejs/vue.min.js"></script>
    <script src="<?= base_url(''); ?>assets/vuejs/axios.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/js/pages/game.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/user/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
</div>

</body>
