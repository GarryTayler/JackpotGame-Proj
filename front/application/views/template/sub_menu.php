<?php
    if($submenu == 'My_Profile_Settings' || $submenu == 'Privacy_and_Security') {
        ?>
<header class="header_wrap fixed-submenu">
    <div class="container-fluid_sub">
        <div class="sub_menu_label animation" data-animation="fadeInDown" data-animation-delay="0.6s">Account Settings</div>
        <div class="sub_menu_detail">
            <ul>
                <li class="animation" data-animation="fadeInDown" data-animation-delay="0.6s"><a class="nav-link nav_item sub_detail_menu <?= $submenu=='My_Profile_Settings'?'active':''; ?>" href="<?= site_url('Profile'); ?>">My Profile Settings</a></li>
                <li class="animation" data-animation="fadeInDown" data-animation-delay="0.6s"><a class="nav-link nav_item sub_detail_menu <?= $submenu=='Privacy_and_Security'?'active':''; ?>" href="<?= site_url("PrivacySecurity"); ?>">Privacy and Security</a></li>
            </ul>
        </div>
    </div>
</header>
        <?php
    }
    else if($submenu == 'Winners_Board' || $submenu == 'Jumpers_Board') {
        ?>
        <header class="header_wrap fixed-submenu">
            <div class="container-fluid_sub">
                <div class="sub_menu_label animation" data-animation="fadeInDown" data-animation-delay="0.6s">Leaderboard</div>
                <div class="sub_menu_detail">
                    <ul>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="0.6s"><a class="nav-link nav_item sub_detail_menu <?= $submenu=='Winners_Board'?'active':''; ?>" href="<?= site_url('Leaderboard'); ?>">Winner Board</a></li>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="0.6s"><a class="nav-link nav_item sub_detail_menu <?= $submenu=='Jumpers_Board'?'active':''; ?>" href="<?= site_url("JumpersBoard"); ?>">Jumpers Board</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <?php
    }
    else if($submenu == 'roulette' || $submenu == 'crash' || $submenu == 'jackpot' || $submenu == 'ladder') {
        ?>
        <header class="header_wrap fixed-submenu">
            <div class="container-fluid_sub">
                <div class="sub_menu_label animation" data-animation="fadeInDown" data-animation-delay="0.6s">Game</div>
                <div class="sub_menu_detail">
                    <ul>
                        <li class="animation submenu_li" data-animation="fadeInDown" data-animation-delay="0.6s">
                            <img src="<?= base_url(); ?>assets/user/images/new/roulette_menu_icon.png" />
                            <a class="nav-link nav_item sub_detail_menu <?= $submenu=='roulette'?'active':''; ?>" href="<?= site_url('Roulette'); ?>">
                                Roulette
                            </a>
                        </li>
                        <li class="animation submenu_li" data-animation="fadeInDown" data-animation-delay="0.6s">
                            <a class="nav-link nav_item sub_detail_menu <?= $submenu=='ladder'?'active':''; ?>" href="<?= site_url("Ladder"); ?>">
                                Ladder
                            </a>
                        </li>
                        <li class="animation submenu_li" data-animation="fadeInDown" data-animation-delay="0.6s">
                            <img src="<?= base_url(); ?>assets/user/images/new/jackpot_menu_icon.png" />
                            <a class="nav-link nav_item sub_detail_menu <?= $submenu=='jackpot'?'active':''; ?>" href="<?= site_url("Jackpot"); ?>">
                                Jackpot
                            </a>
                        </li>
                        <li class="animation submenu_li" data-animation="fadeInDown" data-animation-delay="0.6s">
                            <img src="<?= base_url(); ?>assets/user/images/new/crash_menu_icon.png" />
                            <a class="nav-link nav_item sub_detail_menu <?= $submenu=='crash'?'active':''; ?>" href="<?= site_url("Crash"); ?>">
                                Crash
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <?php
    }
?>
