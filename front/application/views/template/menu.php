<!-- START HEADER -->
<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #4241b8;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  top: 55px;
  border-radius: 6px;
}

.dropdown-content a {
  color: black;
  padding: 6px 14px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #39389e;}

.show {display: block;}

.navbar-collapse.in {
    display: block;
}
.open .dropdown-menu {
    display: block;
    animation-duration: 4s;
  animation-delay: 2s;
}
</style>

<header class="header_wrap fixed-top">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg">
			<a class="navbar-brand animation" href="<?= site_url(''); ?>" data-animation="fadeInDown" data-animation-delay="1s"> 
            	<img class="logo_light" src="<?= base_url(''); ?>assets/user/images/logo_rush.png" alt="logo" />
                <img class="logo_dark" src="<?= base_url(''); ?>assets/user/images/logo_rush.png" alt="logo" />
                <span class="logo-border"></span>
            </a>
            <button class="navbar-toggler animation" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-animation="fadeInDown" data-animation-delay="1.1s"> 
                <span class="ion-android-menu"></span> 
            </button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item signup <?php echo $menu=='home'?'active':''; ?>" href="<?= site_url(''); ?>">HOME</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item signup <?php echo $menu=='deposit'?'active':''; ?>" href="<?= site_url('Deposit'); ?>">DEPOSIT</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item signup <?php echo $menu=='withdraw'?'active':''; ?>" href="<?= site_url('WithDraw'); ?>">WITHDRAW</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item signup <?php echo $menu=='faq'?'active':''; ?>" href="<?= site_url('Faq'); ?>">FAQ</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item signup <?php echo $menu=='referral'?'active':''; ?>" href="<?= site_url('Referral'); ?>">REFERRAL</a></li>
                </ul>
                <ul class="navbar-nav align-items-center m-auto right-menu">
                    <?php
                    if( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
                        ?>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="2s" style="margin-right: 10px; display: flex;align-items: center;color: white;">
                            <div class="dropdown">
                                <div class="profile_dropdown_btn dropdown-toggle" style="display:flex; flex-direction: row; align-items:center;" data-toggle="dropdown">
                                    <img src="<?= base_url(''); ?>assets/user/images/online.png" class="online_avatar" />
                                    <img src="<?php echo base_url()?>uploads/profile/<?php echo $this->session->userdata('AVATAR');?>" class="profile_avatar" alt="profile_avatar" onerror="this.src='<?php echo base_url();?>assets/user/images/no_avatar.jpg'">
                                    <div style="display: flex; flex-direction: column; align-items: center;" class="avatar_range">
                                        <div style="display: flex; flex-direction: row; align-items: center;">
                                            <div id="avatar_name">
                                                <?= $_SESSION['USERNAME']; ?>
                                            </div>
                                        </div>
                                        <span class="bet_label vip_level" style="display: none;">Level 1</span>
                                    </div>
                                </div>
                                <ul class="dropdown-menu list_none"> 
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="<?= site_url("Profile"); ?>">
                                            My Profile
                                        </a>
                                    </li> 
                                    <!--<li>
                                        <a class="dropdown-item nav-link nav_item" href="<?/*= site_url('Referral'); */?>">
                                            Referral
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="#contact">
                                            Deposit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="#contact">
                                            Withdraw
                                        </a>
                                    </li> 
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="#contact">
                                            My Games
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="#contact">
                                            Messages
                                        </a>
                                    </li>-->
                                    <li>
                                        <a class="dropdown-item nav-link nav_item" href="<?= site_url("User/logout") ?>">
                                            Log Out
                                        </a>
                                    </li> 
                                </ul>
                            </div>
                        </li>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="2s" style="display: flex;flex-direction: row; align-items: center; margin-right: 10px;">
                            <img src="<?= base_url(''); ?>assets/user/images/t-coin2.png" class="profile_icon1" />
                            <div id="profile_balance">
                                <?php file_put_contents("balance.txt", $this->session->userdata('WALLET')); echo number_format($this->session->userdata('WALLET'), 0 , '.' , ' '); ?>
                            </div>
                            <img src="<?= base_url(''); ?>assets/user/images/plus_avatar.png" class="profile_icon2" style="display: none;"/>
                        </li>
                        <!--<li class="animation" data-animation="fadeInDown" data-animation-delay="1.9s">
                            <div class="lng_dropdown">
                            <select name="countries" id="lng_select">
                                <option value='en' data-image="<?/*= base_url(''); */?>assets/user/images/flags/english.png" data-title="English">EN</option>
                                <option value='ko' data-image="<?/*= base_url(''); */?>assets/user/images/flags/korean.png" data-title="France">KO</option>
                                <option value='cn' data-image="<?/*= base_url(''); */?>assets/user/images/flags/chinese.png" data-title="China">CN</option>
                            </select>
                            </div>
                        </li>-->
                        <?php
                    }
                    else {
                        ?>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="2s" style="margin-right: 10px;"><a class="nav-link nav_item menu-btn" href="<?= site_url("Login"); ?>">Login</a></li>
                        <li class="animation" data-animation="fadeInDown" data-animation-delay="2.1s" style="margin-right: 10px;"><a class="nav-link nav_item signup menu-btn" href="<?= site_url("Signup"); ?>">Sign Up</a></li>
                        <!--<li class="animation" data-animation="fadeInDown" data-animation-delay="1.9s">
                            <div class="lng_dropdown">
                            <select name="countries" id="lng_select">
                                <option value='en' data-image="<?/*= base_url(''); */?>assets/user/images/flags/english.png" data-title="English">EN</option>
                                <option value='ko' data-image="<?/*= base_url(''); */?>assets/user/images/flags/korean.png" data-title="France">KO</option>
                                <option value='cn' data-image="<?/*= base_url(''); */?>assets/user/images/flags/chinese.png" data-title="China">CN</option>
                            </select>
                            </div>
                        </li>-->
                        <?php
                    }
                    ?>
                </ul>
			</div>
		</nav>
	</div>
</header>

<?php
/*    if( !( isset($data['sidebar']) &&  $data['sidebar'] ) && $submenu != '' ) {
        require_once('application/views/template/sub_menu.php'); 
    }
*/?>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  if($('#myDropdown').hasClass("show")) 
    $('#myDropdown').removeClass("show");
  else
    $('#myDropdown').addClass("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.avatar_range') && !event.target.matches('.profile_dropdown_btn') && !event.target.matches('#avatar_name') && !event.target.matches('.profile_avatar') && !event.target.matches('.vip_level') && !event.target.matches('.fa-angle-down')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }

}
</script>