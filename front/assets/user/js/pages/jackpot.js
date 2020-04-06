// socket part start ==========
var firework_timer = null, firework_x = 0, firework_y = 0;
jackpot_socket.on('Init', function(resp) {
	// initialize data from server
	app.last_winner = resp.last_winner;
	app.last_winner.AVATAR = base_url + "uploads/profile/" + app.last_winner.AVATAR;
		if (app.last_winner) app.last_winner_exist = true;
	app.bets = resp.bets;
	app.players = resp.players;
	app.game = resp.game;
	if (timerHandler) {
		clearInterval(timerHandler);
		timerHandler = null;
	}
	// THERE ARE FOUR STATUS
	if (resp.status == 'WAITING') {
		// we need to do nothing
	} else if (resp.status == 'STARTED') {
		// timer running
		render_time_bar();
		timerHandler = setInterval(time_down, 1000);
	} else if (resp.status == 'ROTATE') {
		// rotating -- means you neds to start rotate
		// rotate to given angle
		Rotate.start(resp.rotation);
	} else if (resp.status == 'FINISHED') {
		// timer is cleared, the only thing we have to do rotate to final angle
		app.finish(resp.curAngle, resp.winner);
	}
	if (resp.status != 'ROTATE') {
		$("#div-rotate").css('transform', '');
	}
	BettingPanel.refresh();
	if (!user_id) return;
	app.player_index = -1;
	for (var i = 0; i < app.players.length; i += 1) {
		if (app.players[i].USERID == user_id) {
			app.player_index = i;
			return;
		}
	}
	render_time_bar();
});
jackpot_socket.on('Started', function(time_left) {
	if (timerHandler) {
		clearInterval(timerHandler);
		timerHandler = null;
	}
	app.game.TIME_LEFT = time_left;
	render_time_bar();
	timerHandler = setInterval(time_down, 1000);
});
jackpot_socket.on('Rotate', function(rotation) {
	if (timerHandler) {
		clearInterval(timerHandler);
		timerHandler = null;
	}
	app.game.TIME_LEFT = 0; // time gone already ...
	Rotate.start(rotation);
});
jackpot_socket.on('Finish', function (resp) {
	if (timerHandler) {
		clearInterval(timerHandler);
		timerHandler = null;
	}
	app.finish(
		resp.curAngle,
		resp.winner_id
	);
});
jackpot_socket.on('Update', function (resp) {
	app.player_index = -1;
	app.bets = resp.bets;
	app.players = resp.players;
	app.game = resp.game;
	// refresh panel
	BettingPanel.refresh();
	if (!user_id) return;
	for (var i = 0; i < app.players.length; i += 1) {
		if (app.players[i].USERID == user_id) {
			app.player_index = i;
			return;
		}
	}
});
jackpot_socket.on('disconnect' , function() {
	showToast('error' , 'Game server might have network problem. Please check  your internet connection.');
});
// socket part end ============
// there my boy, we have three things to complete bet
// colors for chart
var colors = [
    '#ff8229', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
    '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0',
    '#1e90ff', '#ff6347', '#7b68ee', '#00fa9a', '#ffd700',
    '#6b8e23', '#ff00ff', '#3cb371', '#b8860b', '#30e0e0'
];

var service = axios.create({
    baseURL: site_url,
    timeout: 5000
});

var timerHandler = null;
var jackpanel;

/**
 * fireworks code
 * */

var firework_index = 1;
var user_anim_index = 1;
var app = new Vue({
    el: '#main-container',
    data: {
		player_index: -1,
        // game info
        game: {
            ID: 12,
            HASH: '1234567813',
            TOTAL_BETTING_AMOUNT: 0,
            TIME_LEFT: 90,
            STARTED: false // timer is running or not ( i mean more than two betted? )
        },
        last_bet_id: 0,
        flag_sound: true,
        flag_loaded: false,
        // current players
        bets: [
            {
                USERID: 1,
                USERNAME: 'Karlson',
                AVATAR: '',
                BET_AMOUNT: 1000,
                CHANCE: 0,
                COLOR: '#FFF' // white
            }
		],
		players: [], // SAME AS bets, but is grouped with player

        // jackpot circle

        // last_winner
        last_winner: {
            AVATAR: '',
            USERNAME: 'Karlson',
            BET_AMOUNT : 150,
            WIN_CHANCE : 29
        },
        last_winner_exist: false,
        // deposit
        input_deposit: '',
        deposits: [
            '+1K',
            '+10K',
            '+100K',
            '1/2',
            'X2',
            'MAX'
        ]
    },
    computed: {
        formatted_time: function() {
            var str = Math.floor(this.game.TIME_LEFT / 60) + ':';
            if (this.game.TIME_LEFT % 60 < 10) str += '0';
            str += this.game.TIME_LEFT % 60;
            return str;
        },
        reversed_bets:function() {
            var t_arr = [];
            for (var index = this.bets.length -1; index >= 0; index -= 1) {
                t_arr.push(this.bets[index]);
            }
            return t_arr;
		},
		my_bet: function() {
			if (this.player_index >= 0) {
				var t = this.players[this.player_index];
				return {
					BET_AMOUNT: t.BET_AMOUNT,
					CHANCE: parseInt(t.BET_AMOUNT * 10000 / this.game.TOTAL_BETTING_AMOUNT) / 100
				};
			} else {
				return {
					BET_AMOUNT: 0,
					CHANCE: 0
				};
			}
		}
    },
    methods: {
        clear_deposit_input:function() {
            this.input_deposit = ''
        },
        on_deposit_1:function(key) {
            this.input_deposit *= 1;
            switch (key) {
                case "+1K":
                    this.input_deposit += 1000;
                    break;
                case '+10K':
                    this.input_deposit += 10000;
                    break;
                case '+100K':
                    this.input_deposit += 100000;
                    break;
                case '1/2':
                    this.input_deposit /= 2;
                    break;
                case 'X2':
                    this.input_deposit *= 2;
                    break;
                case 'MAX':
                    this.on_max();
                    break;
                default:
                    console.log('Error Occured');
            }
        },
        on_max:function() {
            // get max available from server, then set it
            var self = this;
            send_request('jackpot/ajax_max_amount',
                function(resp) {
                    if (resp.status) {
                        self.input_deposit = resp.wallet;
                    } else {
                        if (resp.msg == 'You have to login first.') window.location.href = site_url + 'Login';
                        // alert(resp.msg);
                    }
                }
            );
        },
        on_deposit:function() {
			if (user_id == 0 || app.game.STARTED) return; // cannot deposit when u're not logged in, or game already started

            var deposit_amount = parseFloat(this.input_deposit);
            if (isNaN(deposit_amount) || deposit_amount == 0 ) {
                // alert warning
                showToast('error', 'Please input correct value');
                return;
			}
			// send to server deposit info
			send_request(
				'jackpot/ajax_deposit',
				function(resp) {
					if (!resp.status) {
						showToast('error', resp.msg);
					}else {
						$("#profile_balance").html(resp.balance);
					}
				},
				{
					game_id: app.game.ID,
					deposit_amount: deposit_amount
				}
			);
        },
        show_history:function() {
			// show modal with history data
			// not done yet.
		},
		finish: function(angle, winner) {
			$("#div-rotate").css('transform', 'rotate3d(0, 0, 1, ' + angle + 'deg)');
			// alert user the result ... but we don't run this code
			BettingPanel.startFirworks();
			if (user_id == winner) {
				update_wallet();
				showToast('success', 'You are the winner !');
			} else {
				update_wallet();
				showToast('warning', 'You loose~');
			}
		},
		number_format: function(num) {
			num = parseInt(num);
			num = num.toString();
			var splitString = num.split("");
			var reverseArray = splitString.reverse();
			num = reverseArray.join("");
			var result = "";
			var gap_size = 3; //Desired distance between spaces
			while (num.length > 0) // Loop through string
			{
				if(result.length > 0)
					result = result + " " + num.substring(0,gap_size); // Insert space character
				else
					result = num.substring(0,gap_size); // Insert space character
				num = num.substring(gap_size);  // Trim String
			}
			splitString = result.split("");
			reverseArray = splitString.reverse();
			result = reverseArray.join("");
			return result;
		}
    }
});

function send_request(url, process = function(resp){}, data = false) {
    // there's an error that i cant' resolve ... related to axios
    service.request({
        url: site_url + url,
        method: 'POST',
        params: data
    }).then(function(result) {
        process(result.data);
    });
}

// circle --> show bettings,f rotate
var BettingPanel = function() {
	return {
		refresh: function() {
			this.initChart();
		},
		startFirworks: function () {
			firework_x = firework_y = 0;
			firework_timer = setInterval(this.fireworksFunc, 40);
		},
		fireworksFunc: function () {	
			$('#fireworks').css('background-position', firework_x + 'px '+ firework_y + 'px');
			firework_x -= 200;
			if(firework_x < -1600)
			{
				firework_y -= 200;
				firework_x = 0;
			}
			if(firework_y < -1800) {
				firework_y = 0;
				clearInterval(firework_timer);
				firework_timer = null;
			}
        },
		initChart: function() {
			var ctx = document.getElementById('myChart');//.getContext('2d');

            resizeChartArea(false);

			// we make datasets from game betting data
			// here...
			var betting = [];
			var backgroundColor = [];

			var labels = [];
			for (var i = 0; i < app.players.length; i += 1) {
				betting.push(app.players[i].BET_AMOUNT);
				backgroundColor.push(colors[i % colors.length]);
				labels.push(app.players[i].USERNAME);
			}
			var config = {
				type: 'doughnut',
				data: {
					datasets: [{
						data: betting,
						backgroundColor: backgroundColor,
						borderWidth: 0
					}],
					labels: labels
				},
				options: {
					cutoutPercentage: 82,
					label: {
						display: false
					},
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
					},
					responsive:true,
					maintainAspectRatio:true,
				},
			};
			if (jackpanel != undefined) {
				jackpanel.destroy();
				jackpanel = undefined;
			}
			jackpanel = new Chart(ctx, config);
        }
	}
}();

function render_time_bar() {
	// $('#div-time-left').css('width', 200 * app.game.TIME_LEFT / 90);
	$('#div-time-elapsed').css('width', 100 * (90 - app.game.TIME_LEFT)/ 90 + '%');
}

function time_down() {
	if (app.game.TIME_LEFT > 0) {
		app.game.TIME_LEFT -= 1;
		render_time_bar();
	} else {
		clearInterval(timerHandler);
		timerHandler = null;
		// then start rotate ?
		// server will send you, just wait ...
	}
}

$(document).ready(function() {
    resizeChartArea(true);
	window.onfocus = function() {
		jackpot_socket.emit('Init'); // needs refresh
	};
	jackpot_socket.emit('Init');
});

$(window).resize(function(w) {
	resizeChartArea(false);
	// BettingPanel.refresh();
});

function resizeChartArea(initStatus) {
    set_layout();
    var w = $('#div-chart').width();
	if(initStatus){
		$('#myChart').attr('width', w);
		$('#myChart').attr('height', w);
	}
	var divRelativeW = $('#div-relative').width();
    $('#jackpotTitle').css('font-size', divRelativeW / 9);
    $('#jackpotTitle').css('margin-bottom', divRelativeW / 13);

    $('#jackpotTitle').css('margin-top', divRelativeW / 4.5);
    $('#betting_total').css('font-size', divRelativeW / 7);
    $('#time-progress-bar').css('width', divRelativeW / 2.2);
    if (window.innerWidth < 992) {
        $('#betting_total').parent().css('margin-bottom', divRelativeW / 30);
        $('img.jackpot-timer').css('width', 18);
        $('img.jackpot-timer').css('height', 18);
	} else {
        $('#betting_total').parent().css('margin-bottom', 45);
        $('img.jackpot-timer').css('width', 30);
        $('img.jackpot-timer').css('height', 30);
	}
    const is_mobile = ($(window).width() <= 756);
    if (is_mobile) {
        $("#current_players").css('min-height', 'auto');
        $("#current_players").css('max-height', '400px');
	} else {
        $("#current_players").css('max-height', $(".deposit-wrapper").height() + 'px');
	}
}

var Rotate = function() {
	// const variables
	var maxSpeed;// this variable must be same with server side (backend)

	// rotation variables
	var slowDownStartAngle;
	var isRunUp;
	var isSlowDown;
	var curAngle;
	var stopAngle;
	var rate = 0; // to calc speed

	var rotate = function() {
		var speed_ = speed_ = rate * rate / 10;
		if (isRunUp) {
			if (speed_ < maxSpeed) {
				rate += 0.2;
			} else {
				isRunUp = false;
			}
		} else {
			if (isSlowDown) {
				if (speed_ > 2) {
					rate -= 0.1;
				} else if (speed_ > 1) {
					rate -= 0.05;
				} else if (speed_ > 0.1) {
					rate -= 0.02;
				}
			} else {
				if (curAngle > slowDownStartAngle) {
					isSlowDown = true;
				}
			}
		}
		if (curAngle >= stopAngle) {
			clearInterval(timerHandler);
			timerHandler = null;

			curAngle = stopAngle; // just finish at correct position
			// now we wait for finish action ...
		} else {
			curAngle += speed_;
		}

		$("#div-rotate").css('transform', 'rotate3d(0, 0, 1, ' + curAngle + 'deg)');
	};

	return {
		start: function(params) {
			stopAngle = params.stopAngle;
			slowDownStartAngle = params.slowDownStartAngle;
			isRunUp = params.isRunUp;
			isSlowDown = params.isSlowDown;
			curAngle = params.curAngle;
			rate = params.rate;
			maxSpeed = params.maxSpeed;

			if (app.game.TIME_LEFT > 0) {
				app.game.TIME_LEFT = 0;
				render_time_bar();
			}

			$("#div-rotate").css('transform', 'rotate3d(0, 0, 1, ' + curAngle + 'deg)');
			if (timerHandler) {
				clearInterval(timerHandler);
				timerHandler = null;
			}
			timerHandler = setInterval(rotate, 20);
			rotate();
		}
	};
}();
