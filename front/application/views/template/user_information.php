<link rel="stylesheet" href="<?= base_url(''); ?>assets/user/css/user_info.css">

            <div class="row animation" data-animation="fadeInUp" data-animation-delay="1.3s">
                <div class="ticket_panel bet_panel user_info_div" style="padding-bottom: 0px;">
                    <div class="row heading_div">
                        <div class="col-sm-12 parallelogram1">
                            <div>User Informations</div>
                            <div class="method"><i class="fa fa-pencil"></i></div>
                        </div>
                    </div>                    

                    <div class="row">
                        <div class="col-sm-12" style="text-align: center;">
                            <div class="user_avatar_name">
                                M.Eric
                            </div>
                            <div>
                                <img src="<?= base_url(); ?>assets/user/images/new/profile.png" class="avatar_image3" />
                                <img src="<?= base_url(); ?>assets/user/images/new/vip.png" class="vip_image" />
                            </div>
                            <div class="user_level">
                                LEVEL1
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 6px;">
                        <div class="col-sm-12 progress_div">
                            <div class="progress_back">
                                <div class="progress_bar">
                                </div>
                            </div>   
                        </div>
                    </div>
                    
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-12 label_text">
                            38 more EXP to Level 2
                        </div>
                    </div>

                    <div class="row divided_separate1">
                    </div>
                    <div class="row divided_separate2">
                    </div>

                    <div class="row label_text1 balance_label_div">
                        <div class="col-sm-12">
                            Balance
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 balance_amount_div">
                            <img src="<?= base_url(); ?>assets/user/images/new/avatar_mark.png" class="balance_img" />
                            <span class="yellow-color">
                                4,325
                            </span>
                        </div>
                        <div class="col-sm-4 deposit_btn" style="padding-right:0px;">
                            <div class="parallelogram_button_type2_small">
                                Deposit
                            </div>
                        </div>
                        <div class="col-sm-4 widthdraw_btn" style="padding-right:0px;">
                            <div class="parallelogram_button_type1_small">
                                Withdraw
                            </div>
                        </div>
                    </div>
                    
                    <div class="row divided_separate1">
                    </div>
                    <div class="row divided_separate2">
                    </div>

                    <div class="row label_text1" style="margin-bottom: 6px;">
                        <div class="col-sm-6">
                            VIP Ranking
                        </div>
                        <div class="col-sm-6 user_level" style="text-align:right;">
                            21/50 XP
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 6px;">
                        <div class="col-sm-12 progress_div">
                            <div class="progress_back">
                                <div class="progress_bar">
                                </div>
                            </div>   
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-12 label_text">
                            Each single bet of 15,000+ Coins counts 1 XP
                        </div>
                    </div>

                    <div class="row divided_separate1">
                    </div>
                    <div class="row divided_separate2">
                    </div>

                    <div class="row label_text2" style="margin-bottom: 6px;">
                        <div class="col-sm-6">
                            Tips Sent
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 6px; color: #7c63a3;">
                            0
                        </div>
                        <div class="col-sm-6">
                            Tips Received
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 6px; color: #7c63a3;">
                            0
                        </div>
                        <div class="col-sm-6">
                            Coin Rain
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 6px; color: #7c63a3;">
                            0
                        </div>
                    </div>

                    <div class="row divided_separate1">
                    </div>
                    <div class="row divided_separate2">
                    </div>

                    <div class="row label_text1" style="margin-bottom: 30px;">
                        <div class="col-sm-8 name_promotion_label">
                            Name Promotion
                        </div>
                        <div class="col-sm-4 yellow-color status_div" style="text-align:right; font-size:14px;">
                            Activated
                        </div>
                    </div>


                  <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                  <?php
                  if ( isset($data['user_submenu']) && $data['user_submenu']) {
                      ?>

                      <div class="row user_informations_panel1">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/account_settings.png" class="user_informations_panel_img" />
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                Account Settings
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel2">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/referrals.png" class="user_informations_panel_img" />    
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                <a href="<?= base_url('Referral'); ?>" class="user_information_sub_menu">
                                    Referrals
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel1">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/deposit.png" class="user_informations_panel_img" />
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                Deposit
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel2">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/withdraw.png" class="user_informations_panel_img" />    
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                Withdraw
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel1">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/mygames.png" class="user_informations_panel_img" />    
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                My Games
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel2">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/message.png" class="user_informations_panel_img" />    
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                Message
                            </span>
                        </div>
                    </div>
                    <div class="row user_informations_panel1">
                        <div class="col-sm-2">
                            <img src="<?= base_url(); ?>assets/user/images/new/help_center.png" class="user_informations_panel_img" />    
                        </div>
                        <div class="col-sm-10">
                            <span class="margin-left-8">
                                Help Center
                            </span>
                        </div>
                    </div>

                      <?php
                  }
                  ?>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                </div>
            </div>