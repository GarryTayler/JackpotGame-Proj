var express = require('express');  
var app = express();  
var server = require('http').createServer(app);  
var io = require('socket.io')(server);
var config = require('../config');
var bodyParser = require('body-parser');
var request = require('request');
const mainServerUrl = config.main_host_url + '/jackpot/';

server.listen(config.jackpot_port, function(){
  console.log('listening on *:' + config.jackpot_port);
});

app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(bodyParser.json({type: 'application/vnd.api+json'})); // parse application/vnd.api+json as json

/* ======= api group =======*/
app.use(function (req, res, next) {
    // Website you wish to allow to connect
    res.setHeader('Access-Control-Allow-Origin', '*');
    // res.setHeader('Access-Control-Allow-Origin', config.main_host_url);
    // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    res.setHeader('Access-Control-Allow-Credentials', true);
    // Pass to next layer of middleware
    next();
});

app.post('/jackpot/ajax_deposit', function (req, res) {
	// do this later
	if (!checkLogin(req.body.token)) {
		return res.json({
			status: true,
            msg:'You have to login first.'
		})
	}
	let gameID = req.body.game_id;
	let depositAmount = req.body.deposit_amount;
	getUserInfo(req.body.token, function(userInfo){
		// check if this amount is available on wallet
		if (userInfo.wallet < depositAmount) {
			return res.json({
				status: false,
				msg: 'Not enough wallet.'
			})
		}

		// check game winner
		let sql = `select * from jackpot_home where ID='${gameID}`;
		con.query(sql, function(err, result){
			if (err) return res.json({status: false, msg: 'Invalid Game Data.'});
			if (result.length > 0 && result[0]) {

			}
			return res.json({status: false, msg: 'Invalid Game Data.'});
		});

		let betInfo = {
			USERID: userInfo.userid,
			BET_AMOUNT: parseFloat(depositAmount),
			AVATAR: userInfo.avatar,
			USERNAME: userInfo.username
		};
		Jackpot.new_bet(betInfo);
		res.json({'error_code' : 0});
	});
});

app.post('/jackpot/ajax_max_amount', function(req, res){
	if(!checkLogin(req.body.token)) {
		return res.json({
			status: false,
			msg: 'You should login first.'
		});
	}
	getUserInfo(req.body.token, function(userInfo){
		res.json({
			status: true,
			wallet: userInfo.wallet
		})
	});
});

app.post('/new_deposit', function(req, res) {
	let betInfo = {
		USERID: req.body.USERID,
		BET_AMOUNT: parseFloat(req.body.BET_AMOUNT),
		AVATAR: req.body.AVATAR,
		USERNAME: req.body.USERNAME
	};
	Jackpot.new_bet(betInfo);
	res.json({'error_code' : 0});
});


/**
 *  to do here add login secion
 * @param userToken: user token or id
 */
function checkLogin(userToken) {
    return true;
}

/**
 *
 * @param token
 * @param cb
 */
function getUserInfo(token, cb) {

    let sql = `select * from users where API_TOKEN='${token}'`;
    con.query(sql, function (err, result) {
        if (err) throw err;
        let userObj = result[0];
        let userInfo =  {
            avatar: userObj['AVATAR'],
            userid: userObj['ID'],
            username: userObj['USERNAME'],
            wallet: userObj['WALLET_BLOCK'],
        };
        return cb(userInfo);
    });

}

function check_round_finishable() {
	// do this later........
}

io.on('connection', function(socket) {
    console.log('a new user connected');
    socket.on('disconnect', function(data) {
      // when disconnect ; do sth
	});
	// we send him current round - bets, players
	socket.on('Init', function() {
		socket_init(socket);
	});
	socket_init(socket);
});

function socket_init(socket)
{
	var params = Jackpot.params();

	if (params.status == 'ROTATE') {
		// when it's rotating, you have to send rotating info
		params.rotation = Rotate.params();
	}
	socket.emit('Init', params);
}

var Jackpot = function() {
	var timerID;
	// game variables
	var status = 'INIT' , game , players , bets , last_winner , cur_winner;

	var start_game = function(time_left) {
		status = 'STARTED';
		game.TIME_LEFT = time_left;
		io.emit('Started', game.TIME_LEFT);
		timerID = setInterval(intervalFunc, 1000);
	};

	var intervalFunc = function() {
		if (game.TIME_LEFT > 0) {
			game.TIME_LEFT -= 1;
		}
		if (game.TIME_LEFT <= 0) {
			clearInterval(timerID);
			start_rotate();
		}
	};

	var start_rotate = function() {
		request.post({
			url: mainServerUrl + 'ajax_get_winner/' + game.ID,
			formData: {}
		}, function(error, response, body) {
			var ret = JSON.parse(body);
			if (ret.status) {
				status = 'ROTATE';
				var stopAngle = 0;
				for (var i = 0; i < players.length; i += 1) {
					if (players[i].USERID == ret.winner) {
						cur_winner = players[i]; // we set last winner here ...
						break;
					}
					stopAngle += players[i].BET_AMOUNT;
				}
				stopAngle += Math.random() * cur_winner.BET_AMOUNT;
				// stopAngle += 0.5 * cur_winner.BET_AMOUNT;
				stopAngle = stopAngle / game.TOTAL_BETTING_AMOUNT * 360;
				// we should make circle should slowly rotate for at least 90 degree, but not over 120 degree
				status = 'ROTATE';
				Rotate.start(stopAngle);
				io.emit('Rotate', Rotate.params());
			} else {
				console.log('error occurred', ret);
			}
		});
	};

	return {
		init: function() {
			request.post({
				url: mainServerUrl + 'ajax_round_info',
				formData: {}
			}, function (error, response, body) {
				var ret = JSON.parse(body);
				if (ret.status) {
					// init game variables
					game = ret.game;
					bets = ret.bets;
					players = ret.players;
					for (var i = 0; i < bets.length; i += 1) {
						bets[i].CHANCE = parseInt(10000 * bets[i].BET_AMOUNT / game.TOTAL_BETTING_AMOUNT) / 100;
					}
					last_winner = ret.last_winner;
					// send players current round INFO
					status = 'WAITING';
					io.emit('Init', Jackpot.params()); // --> when jackpot inits, it is waiting status
					if (game.STARTED) {
						// status = 'STARTED';
						start_game(game.TIME_LEFT); // we send them twice 'STARTED' signal ...
					}
				} else {
					//console.log'error occurred - init', ret);
				}
			});
		},
		finish: function() {
			status = 'FINISHED';
			setTimeout(function() {
				last_winner = cur_winner;
				Jackpot.init();
			}, 4000);
			var params = Rotate.params();
			params.winner_id = cur_winner.USERID; // users should know who's the winner ...
			io.emit('Finish', params);
		},
		new_bet: function(betInfo) {
			bets.unshift(betInfo);
			game.TOTAL_BETTING_AMOUNT = parseFloat(game.TOTAL_BETTING_AMOUNT) + betInfo.BET_AMOUNT;
			for (var i = 0; i < bets.length; i += 1) {
				bets[i].CHANCE = parseInt(10000 * bets[i].BET_AMOUNT / game.TOTAL_BETTING_AMOUNT) / 100;
			}
			for (var i = 0; i < players.length; i += 1) {
				if (players[i].USERID == betInfo.USERID) {
					players[i].BET_AMOUNT = parseFloat(players[i].BET_AMOUNT) + betInfo.BET_AMOUNT;
					break;
				}
			}
			if (i == players.length) {
				var new_player = {
					USERID: betInfo.USERID,
					BET_AMOUNT: betInfo.BET_AMOUNT,
					AVATAR_MEDIUM: betInfo.AVATAR_MEDIUM,
					USERNAME: betInfo.USERNAME
				};
				players.push(new_player);
				if (players.length >= 2 && status != 'STARTED') {
					start_game(90); // modify this to 90 for real game
				}
			}
			io.emit('Update', {
				players: players,
				bets: bets,
				game: game
			});
		},
		params: function() {
			var retObj = {
				status: status,
				game: game,
				last_winner: last_winner,
				players: players,
				bets: bets
			};
			if (status == 'FINISHED') {
				var params = Rotate.params();
				retObj.winner_id = cur_winner.USERID;
				retObj.curAngle = params.curAngle;
			}
			return retObj;
		}
	}
}();

var Rotate = function() {
	// const variables
	const maxSpeed = 18;
	const runUpAngle = 365;
	const slowAngle = 895; // angle cost for ; rotate slows from max speed to zero ...
	// rotation variables
	var slowDownStartAngle , isRunUp , isSlowDown , curAngle , stopAngle , rate = 0; // to calc speed

	var rotate = function() {
		var speed_ = rate * rate / 10;
		if (isRunUp) {
			if (speed_ < maxSpeed) 
				rate += 0.2;
			else 
				isRunUp = false;
		} 
		else {
			if (isSlowDown) {
				if (speed_ > 2) 
					rate -= 0.1;
				else if (speed_ > 1) 
					rate -= 0.05;
				else if (speed_ > 0.1) 
					rate -= 0.02;
				else {
				}
			} else {
				if (curAngle > slowDownStartAngle) 
					isSlowDown = true;
			}
		}
	
		if (curAngle >= stopAngle) {
			curAngle = stopAngle; // just finish at correct position
			Jackpot.finish();
		} else {
			curAngle += speed_;
			setTimeout(function() {
				rotate();
			}, 20);
		}
	};
	return {
		start: function(stopAngle1) {
			stopAngle = runUpAngle + 2160 + slowAngle + stopAngle1;
			slowDownStartAngle = stopAngle - slowAngle;
			isRunUp = true;
			isSlowDown = false;
			curAngle = 0;
			rate = 1;
			rotate();
		},
		params: function() {
			return {
				maxSpeed: maxSpeed,
				slowDownStartAngle: slowDownStartAngle,
				isRunUp: isRunUp,
				isSlowDown,
				curAngle,
				stopAngle,
				rate
			};
		}
	};
}();

Jackpot.init();
