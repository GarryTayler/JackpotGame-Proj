<!DOCTYPE html>
<html lang="en">
<?php
    require_once('application/views/template/head.php'); 
?>

<body class="bg_light" style="font-smoothing: antialiased;">

<?php
    require_once('application/views/template/loader.php'); 
?>

<?php
    require_once('application/views/template/menu.php'); 
?>

<link rel="stylesheet" type="text/css" href="<?= base_url('');?>assets/user/plugins/wowSlider/engine1/style.css" />
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
<div class="main_container" style="background:url(<?= base_url('');?>assets/user/images/new/background.jpg) no-repeat center 0">
<!-- START SECTION BANNER -->
<div class="container">

    <div class="row">
        <div class="col-sm-8 left_part">
            <div class="row">
                <div id="wowslider-container1" class="animation" data-animation="fadeInUp" data-animation-delay="1.2s">
                    <div class="ws_images">
                        <ul>
                            <li><img src="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/1920x1080.jpg" alt="1920x1080" title="1920x1080" id="wows1_0"/></li>
                        </ul>
                    </div>
                    <div class="ws_bullets">
                        <div>
                            <a href="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/1920x1080.jpg" title="1920x1080"><span><img src="assets/user/plugins/wowSlider/data1/tooltips/1920x1080.jpg" alt="1920x1080"/>1</span></a>
                            <a href="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/adultcompetitionconcentration929831.jpg" title="adult-competition-concentration-929831"><span>2</span></a>
                            <a href="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/bestleagueoflegendswallpapers1.png" title="Best-League-of-Legends-Wallpapers-1"><span>3</span></a>
                            <a href="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/starcraft2wcsfinals2018.jpg" title="starcraft-2-wcs-finals-2018"><span>4</span></a>
                            <a href="<?= base_url('');?>assets/user/plugins/wowSlider/data1/images/image087.jpg" title="image087"><span>5</span></a>
                        </div>
                    </div>
                    <div class="ws_script" style="position:absolute;left:-99%">
                        <a href="http://wowslider.net">html slideshow</a> by WOWSlider.com v8.8
                    </div>
                    <div class="ws_shadow"></div>
                </div>
            </div>  

            <div class="row" style="margin-top: 30px; color: #fff;">
                <div class="fun_scores animation bet_panel" data-animation="fadeInUp" data-animation-delay="1.3s">
                    
                    <div class="row heading_div" style="margin-left: 0px; margin-right: 0px; margin-bottom: 20px; padding-left: 30px; padding-right: 30px;">
                        <div class="col-sm-5 parallelogram" style="">
                            <span>Fun Scores</span>
                        </div>
                        <div class="col-sm-5 offset-sm-2 history_tab">
                            <ul>
                                <li class="active">
                                    Last 24 Days
                                </li>   
                                <li>
                                    Last 7 Days
                                </li>   
                            </ul>   
                        </div>
                    </div>

                    <div class="row history_list_div" style="padding-left: 30px; padding-right: 30px; margin-left: 0px; margin-right: 0px; justify-content: space-between;">
                        <div class="col-sm-4 history_panel" >
                            <div> Biggest Bet </div>
                            <div class="balance_history">
                                <img alt="avatar_mark" class="avatar_mark" src="<?= base_url(); ?>assets/user/images/new/avatar_mark.png" />
                                <span> 4000000 </span>
                            </div>
                            <div class="grey_color"> Crash </div>
                            <div class="avatar_div">
                                <img alt="avatar" class="avatar1" src="<?= base_url(); ?>assets/user/images/new/profile.png" />
                                <div class="avatar_result">
                                    45
                                </div>
                            </div>
                            <div class="grey_color"> John 1 </div>
                        </div>
                        <div class="col-sm-4 history_panel">
                            <div> Biggest Bet </div>
                            <div class="balance_history">
                                <img alt="avatar_mark" class="avatar_mark" src="<?= base_url(); ?>assets/user/images/new/avatar_mark.png" />
                                <span> 9750000 </span>
                            </div>
                            <div class="grey_color"> Roulette </div>
                            <div class="avatar_div">
                                <img alt="avatar" class="avatar1" src="<?= base_url(); ?>assets/user/images/new/profile.png" />
                                <div class="avatar_result">
                                    89
                                </div>
                            </div>
                            <div class="grey_color"> John 2 </div>
                        </div>
                        <div class="col-sm-4 history_panel">
                            <div> Biggest Bet </div>
                            <div class="balance_history">
                                <img alt="avatar_mark" class="avatar_mark" src="<?= base_url(); ?>assets/user/images/new/avatar_mark.png" />
                                <span> X 15 Wins </span>
                            </div>
                            <div class="grey_color"> Roulette </div>
                            <div class="avatar_div">
                                <img alt="avatar" class="avatar1" src="<?= base_url(); ?>assets/user/images/new/profile.png" />
                                <div class="avatar_result">
                                    78
                                </div>
                            </div>
                            <div class="grey_color"> John 3 </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row" style="margin-top: 30px; color: #fff; line-height: 15px;">
                <div class="latest_news animation bet_panel" data-animation="fadeInUp" data-animation-delay="1.3s">
                    <div class="row heading_div">
                        <div class="col-sm-12 parallelogram" style="">
                            <span>Latest News</span>
                        </div>
                    </div>
                    
                    <div class="row news_panel font_size_13">
                        <div class="col-sm-3 news_avatar">
                             <img alt="news_img" class="news_img" src="<?= base_url(); ?>assets/user/images/new/news3.png">
                        </div>
                        <div class="col-sm-9" style="display: flex; flex-direction: column; justify-content: space-evenly;">
                            
                            <div class="display_row">
                                <img class="news_icon" src="<?= base_url(); ?>assets/user/images/new/joot.png">
                                <div class="display_column" style="margin-left: 20px;">
                                    <div>100 Thieves</div>
                                    <div class="font_size_12" style="color: #e2d5f6;">League of Legends LCS</div>
                                </div>
                            </div>

                            <div class="font_size_18" style="line-height: 20px; margin-top: 10px;">
                                From scrims to stage, 100 Thieves searches for the same page.
                            </div>  

                            <div style="color: #e2d5f6; line-height: 33px;">
                                Apr 4, 2019.
                            </div>
                            <div style="line-height: 18px;">
                                "Going forward we have to win every single game to make playoffs, "100 Thieves support 
                                Zaqueri"aphromoo" Black says.
                            </div>
                        </div>
                    </div>

                    <div class="row news_panel font_size_13">
                        <div class="col-sm-3 news_avatar">
                             <img alt="news_img" class="news_img" src="<?= base_url(); ?>assets/user/images/new/news1.png">
                        </div>
                        <div class="col-sm-9" style="display: flex; flex-direction: column; justify-content: space-evenly;">
                            
                            <div class="display_row">
                                <img class="news_icon" src="<?= base_url(); ?>assets/user/images/new/overwatch.png">
                                <div class="display_column" style="margin-left: 20px;">
                                    <div>Overwatch League</div>
                                    <div class="font_size_12" style="color: #e2d5f6;">Stage 1 Playoffs</div>
                                </div>
                            </div>

                            <div class="font_size_18" style="line-height: 20px; margin-top: 10px;">
                                Overwatch League : Five things we learned in Stage 1
                            </div>  

                            <div style="color: #e2d5f6; line-height: 33px;">
                                Apr 4, 2019.
                            </div>
                            <div style="line-height: 18px;">
                                From Seoul's resurgence to the payoff of San Francisco's waiting game, the first portion the 
                                Overwatch League season showed us plenty of ...
                            </div>
                        </div>
                    </div>

                    <div class="row news_panel font_size_13">
                        <div class="col-sm-3 news_avatar">
                             <img alt="news_img" class="news_img" src="<?= base_url(); ?>assets/user/images/new/news2.png">
                        </div>
                        <div class="col-sm-9" style="display: flex; flex-direction: column; justify-content: space-evenly;">
                            
                            <div class="display_row">
                                <img class="news_icon" src="<?= base_url(); ?>assets/user/images/new/lol.png">
                                <div class="display_column" style="margin-left: 20px;">
                                    <div>League of Legends</div>
                                    <div class="font_size_12" style="color: #e2d5f6;">Global Power Ranking</div>
                                </div>
                            </div>

                            <div class="font_size_18" style="line-height: 20px; margin-top: 10px;">
                                League of Legends global power rankings through March 26
                            </div>  

                            <div style="color: #e2d5f6; line-height: 33px;">
                                Apr 3, 2019.
                            </div>
                            <div style="line-height: 18px;">
                                After serveral major shake-ups Monday night, the League of Legends global power rankings
                                look a bit different than they did last week, with SK ...
                            </div>
                        </div>
                    </div>

                    <div class="row news_panel font_size_13">
                        <div class="col-sm-3 news_avatar">
                             <img alt="news_img" class="news_img" src="<?= base_url(); ?>assets/user/images/new/news4.jpg">
                        </div>
                        <div class="col-sm-9" style="display: flex; flex-direction: column; justify-content: space-evenly;">
                            
                            <div class="display_row">
                                <img class="news_icon" src="<?= base_url(); ?>assets/user/images/new/teamwe.png">
                                <div class="display_column" style="margin-left: 20px;">
                                    <div>Features : Dota PIT Minor 2019</div>
                                    <div class="font_size_12" style="color: #e2d5f6;">
                                        The OGA Dota PIT Minor 2019 is the seventh tournament by One Game Agency. Eight
                                    </div>
                                </div>
                            </div>

                            <div class="font_size_18" style="line-height: 20px; margin-top: 10px;">
                                League of Legneds global power rankings through March 26
                            </div>  

                            <div style="color: #e2d5f6; line-height: 33px;">
                                Apr 3, 2019.
                            </div>
                            <div style="line-height: 18px;">
                                It took a while. but Jacky 'Eternal Envy' Mao has made it to his first Major of the 
                                2018-2019 DPC Season - The MDL Disneyland Paris Major!
                            </div>
                        </div>
                    </div>    

                    <div class="row news_panel font_size_13">
                        <div class="col-sm-3 news_avatar">
                             <img alt="news_img" class="news_img" src="<?= base_url(); ?>assets/user/images/new/news3.png">
                        </div>
                        <div class="col-sm-9" style="display: flex; flex-direction: column; justify-content: space-evenly;">
                            
                            <div class="display_row">
                                <img class="news_icon" src="<?= base_url(); ?>assets/user/images/new/joot.png">
                                <div class="display_column" style="margin-left: 20px;">
                                    <div>100 Thieves</div>
                                    <div class="font_size_12" style="color: #e2d5f6;">League of Legends LCS</div>
                                </div>
                            </div>

                            <div class="font_size_18" style="line-height: 20px; margin-top: 10px;">
                                From scrims to stage, 100 Thieves searches for the same page.
                            </div>  

                            <div style="color: #e2d5f6; line-height: 33px;">
                                Apr 4, 2019.
                            </div>
                            <div style="line-height: 18px;">
                                "Going forward we have to win every single game to make playoffs, "100 Thieves support 
                                Zaqueri"aphromoo" Black says.
                            </div>
                        </div>
                    </div>

                    <div class="row flex-center bottom_div">
                        <img src="<?= base_url(); ?>assets/user/images/new/load_more.png" class="load_more" />
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4 right_part">
            <div class="row animation" data-animation="fadeInUp" data-animation-delay="1.3s">
                <div class="ticket_panel bet_panel">
                    <div class="row heading_div">
                        <div class="col-sm-12 parallelogram1">
                            <div>Your Ticket (35)</div>
                            <div class="method"><a href="#" class='link-color' id="clear_all">Clear All</a></div>
                        </div>
                    </div>

                    <div class="row panel_div font_size_13">
                        <div class="display_row">
                            <div class="item1">Virtus Pro <span class="yellow-color">vs</span> Faze Clan</div>
                            <div class="item2" style="text-align: right;">
                                <i class="fa fa-close link-color"></i>
                            </div>
                            <div class="item3" class="link-color font_size_12"> <span class="yellow-color">Map win:</span> Virtus Pro (1) </div>
                            <div class="item4 parallelogram_btn font_size_12">
                                <span>Place Bet</span>
                            </div>
                            <div class="item5" style="text-align: right;">
                                <span class="bet_label font_size_12">1.5</span>
                            </div>
                        </div>
                    </div>

                    <div class="row panel_div font_size_13">
                        <div class="display_row">
                            <div class="item1">PSG.LGD <span class="yellow-color">vs</span> OG</div>
                            <div class="item2" style="text-align: right;">
                                <i class="fa fa-close link-color"></i>
                            </div>
                            <div class="item3" class="link-color font_size_12"> <span class="yellow-color">Map win:</span> OG (2) </div>
                            <div class="item4 parallelogram_btn font_size_12">
                                <span>Place Bet</span>
                            </div>
                            <div class="item5" style="text-align: right;">
                                <span class="bet_label font_size_12">1.8</span>
                            </div>
                        </div>
                    </div>

                    <div class="row panel_div font_size_13">
                        <div class="display_row">
                            <div class="item1">KOO Tigers <span class="yellow-color">vs</span> Cloud9</div>
                            <div class="item2" style="text-align: right;">
                                <i class="fa fa-close link-color"></i>
                            </div>
                            <div class="item3" class="link-color font_size_12"> <span class="yellow-color">First blood:</span> Kco Tigers(2) </div>
                            <div class="item4 parallelogram_btn font_size_12">
                                <span>Place Bet</span>
                            </div>
                            <div class="item5" style="text-align: right;">
                                <span class="bet_label font_size_12">2.7</span>
                            </div>
                        </div>
                    </div>

                    <div class="row font_size_13" style="line-height: 13px; margin-top:20px; margin-bottom: 10px;">
                        <div class="col-sm-6 summary_text link-color">
                            Total Bet
                        </div>
                        <div class="col-sm-3 summary_num">
                            3,000
                        </div>
                        <div class="col-sm-3 summary_unit">
                            Coins
                        </div>
                    </div>

                    <div class="row font_size_13 yellow-color" style="line-height: 13px;">
                        <div class="col-sm-6 summary_text">
                            Total Potential win
                        </div>
                        <div class="col-sm-3 summary_num">
                            12,700
                        </div>
                        <div class="col-sm-3 summary_unit">
                            Coins
                        </div>
                    </div>

                    <div class="row flex-center margin-bottom-0">
                        <button class="bet_button1">
                            Place Bet
                        </button>
                    </div>
                </div>
            </div>

            <div class="row animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="margin-top: 30px;">
                <div class="match_panel bet_panel">    

                    <div class="row heading_div">
                        <div class="col-sm-12 parallelogram1">
                            <div>Recent Matches</div>
                            <div class="method"><a href="#" class='link-color' id="all_games">All Games</a></div>
                        </div>
                    </div>

                    <div class="row font_size_12 link-color" style="margin-bottom:0px;">
                        04-02 Tuesday
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/dota.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/teamwe.png" >
                            <span class="margin-left-4 link-color">Team WE</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Forward</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/forward.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/csgo.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/navi.png" >
                            <span class="margin-left-4 link-color">OG</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">PSG</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/virus.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/virus.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/joot.png" >
                            <span class="margin-left-4 link-color">Navi</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Team</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/cloud.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/faze.png" >
                            <span class="margin-left-4 link-color">Virtus Pro</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Faze</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/forward.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/teamwe.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/lgd.png" >
                            <span class="margin-left-4 link-color">Cloud9</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Forward</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/lol.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/og.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/forward.png" >
                            <span class="margin-left-4 link-color">Cloud9</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Forward</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/teamwe.png" >
                            <span class="bet_label margin-left-4">Live</span>
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/csgo.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/navi.png" >
                            <span class="margin-left-4 link-color">OG</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">PSGLGO</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/virus.png" >
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/dota.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/og.png" >
                            <span class="margin-left-4 link-color">Team WE</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Forward</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/lgd.png" >
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/dota.png" >
                            <span class="margin-left-4">00:30</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/forward.png" >
                            <span class="margin-left-4 link-color">Team WE</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Team</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/forward.png" >
                        </div>
                    </div>

                    <div class="row font_size_12 link-color" style="margin-bottom:0px;">
                        04-03 Wednesday
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/csgo.png" >
                            <span class="margin-left-4">01:00</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/virus.png" >
                            <span class="margin-left-4 link-color">VirtusPro</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Faze</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/faze.png" >
                        </div>
                    </div>
                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/lol.png" >
                            <span class="margin-left-4">01:00</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/cloud.png" >
                            <span class="margin-left-4 link-color">Cloud9</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <span>VS</span>
                            <span class="margin-left-4 link-color">Forward</span>
                        </div>
                        <div class="col-sm-3 display_row info_div">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/teamwe.png" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="row animation" data-animation="fadeInUp" data-animation-delay="1.3s" style="margin-top: 30px;">
                <div class="match_panel bet_panel">    

                    <div class="row heading_div">
                        <div class="col-sm-12 parallelogram1">
                            <div>World Ranking</div>
                            <div class="method">
                                <img src="<?= base_url(); ?>assets/user/images/new/world_mark.png">
                            </div>
                        </div>
                    </div>

                    <div class="row font_size_11 link-color" style="padding: 0px 20px 0px 20px; margin-bottom:0px;">
                        <div class="col-xs-2 col-sm-2">
                            Rank
                        </div>
                        <div class="col-xs-4 col-sm-4">
                            Team Name
                        </div>
                        <div class="col-xs-4 col-sm-4">
                            Country
                        </div>
                        <div class="col-xs-2 col-sm-2">
                            Points
                        </div>
                    </div>
                    <!-- -->
                    <div class="row panel_div font_size_11" >
                        <div class="display_row" style="width: 100%;">
                            <div class="col-xs-2 col-sm-2 display_row">
                                1
                            </div>
                            <div class="col-xs-4 col-sm-4 display_row">
                                <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                                <span class="margin-left-4">Australis</span>
                            </div>
                            <div class="col-xs-4 col-sm-4 display_row">
                                <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                                <span class="margin-left-4">Denmark</span>
                            </div> 
                            <div class="col-xs-2 col-sm-2 display_row">
                                16:27
                            </div>
                        </div>
                        <div class="display_row" style="width: 100%;">
                            <div style="width: 20%; text-align: center;">
                                <img src="<?= base_url(); ?>assets/user/images/new/avatar3.png" />
                            </div>  
                            <div style="width: 20%; text-align: center; margin-top: 5px;"> 
                                <img src="<?= base_url(); ?>assets/user/images/new/avatar3.png" />
                            </div>  
                            <div style="width: 20%; text-align: center;">
                                <img src="<?= base_url(); ?>assets/user/images/new/avatar3.png" />
                            </div>  
                            <div style="width: 20%; text-align: center;">
                                <img src="<?= base_url(); ?>assets/user/images/new/avatar3.png" />
                            </div>  
                            <div style="width: 20%; text-align: center;">
                                <img src="<?= base_url(); ?>assets/user/images/new/avatar3.png" />
                            </div>  
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>

                    <div class="row panel_div font_size_11" >
                        <div class="col-sm-2 display_row">
                            8
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/australia.png" >
                            <span class="margin-left-4">Australis</span>
                        </div>
                        <div class="col-sm-4 display_row">
                            <img class="matches_img" alt="matches_img" src="<?= base_url(); ?>assets/user/images/new/denmark.png" >
                            <span class="margin-left-4">Denmark</span>
                        </div>
                        <div class="col-sm-2 display_row">
                            16:27
                        </div>
                    </div>
                    <!-- -->
                </div>                
            </div>

        </div>
    </div>

    <div class="row animation liga_image_div" style="margin-top: 30px;" data-animation="fadeInUp" data-animation-delay="1.2s">
        <img class="liga_image" alt="liga_image" src="<?= base_url(); ?>assets/user/images/new/liga.png" />    
    </div>

</div>

<!-- END SECTION BANNER --> 
<?php
    require_once('application/views/template/footer.php'); 
?>
<script type="text/javascript" src="<?= base_url('');?>assets/user/plugins/wowSlider/engine1/wowslider.js"></script>
<script type="text/javascript" src="<?= base_url('');?>assets/user/plugins/wowSlider/engine1/script.js"></script>
</div>
</body>
</html>