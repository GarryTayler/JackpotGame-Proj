<style>

#sidebar {
    height: 100%;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9;
}

#sidebar .sidebarNav {
	position: absolute;
    top: 50%;
    right: 1px;
    z-index: 10;
    display: none;
}

#sidebar .sidebarNav .tab {
	background: #52387a;
    padding: 9px 12px 10px;
    margin: 1px 0;
    cursor: pointer;
    color: #ffffff;
    font-size: 13px;
    /*position: relative; */
	opacity: .8;
	display: flex;
	flex-direction: column;
	align-items: center;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}

#sidebar .sidebarNav .tab:hover {
	opacity: 1;
}

#sidebar .sidebarNav .tab:first-child {
    -webkit-border-radius: 0 3px 0 0;
    -moz-border-radius: 0 3px 0 0;
	border-radius: 6px 0px 0px 0px;
}

#sidebar .sidebarNav .tab .icon_roulette {
	background: url(<?= base_url('');?>assets/user/images/game/roulette_icon.png);
	background-size: 100% 100%;
	width: 40px;
    height: 35px;
}

#sidebar .sidebarNav .tab .icon_ladder {
	background: url(<?= base_url('');?>assets/user/images/game/ladder_icon.png);
	background-size: 100% 100%;
	width: 40px;
    height: 35px;
}

#sidebar .sidebarNav .tab .icon_jackpot {
	background: url(<?= base_url('');?>assets/user/images/game/jackpot_icon.png);
	background-size: 100% 100%;
	width: 40px;
    height: 35px;
}

#sidebar .sidebarNav .tab .icon_crash {
	background: url(<?= base_url('');?>assets/user/images/game/crash_icon.png);
	background-size: 100% 100%;
	width: 40px;
    height: 35px;
}

#sidebar .sidebarNav .tab:last-child {
    -webkit-border-radius: 0 0 3px 0;
    -moz-border-radius: 0 0 3px 0;
	border-radius: 0 0 0 6px;
}

.sidebar_link {
	color: #ffffff;
	font-size: 13px;
	display: flex;
    flex-direction: column;
    align-items: center;
}

</style>

<div id="sidebar">
    <div class="sidebarNav animation" style="margin-top: -108.5px;
    display: none;
	box-shadow: rgba(63, 55, 74 , 0.7 ) -0.01em 0.012em 5px;
    border-radius: 6px 0px 0px 6px;" data-animation="fadeInUp" data-animation-delay="1.3s">
		<div class="tab tab-show" data-id="gamesContent">
			<a class="sidebar_link <?= $submenu=='roulette'?'active':''; ?>" href="<?= site_url('Roulette'); ?>">
				<div class="icon_roulette"></div> 
				<div>
					Roulette		
				</div>
			</a>
		</div>
		<div class="tab tab-show" data-id="ladderContent">
			<a class="sidebar_link <?= $submenu=='ladder'?'active':''; ?>" href="<?= site_url('Ladder'); ?>">
				<div class="icon_ladder"></div> 
				<div>
					Ladder
				</div>
			</a>
		</div>
		<div class="tab tab-show" data-id="jackpotContent">
			<a class="sidebar_link <?= $submenu=='jackpot'?'active':''; ?>" href="<?= site_url('Jackpot'); ?>">
				<div class="icon_jackpot"></div> 
				<div>
					Jackpot
				</div>
			</a>
		</div>
		<div class="tab tab-show" data-id="crashContent">
			<a class="sidebar_link <?= $submenu=='crash'?'active':''; ?>" href="<?= site_url('Crash'); ?>">
				<div class="icon_crash"></div> 
				<div>
						Crash
				</div>
			</a>
		</div>
	</div>
</div>

