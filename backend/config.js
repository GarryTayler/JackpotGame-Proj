var path = require('path');

var config = {
    debug: true,
    base_url : 'http://localhost:7980/',
    // base_url : 'http://ec2-13-209-160-19.noap-northeast-2.compute.amazonaws.com',
    chat_port : 4201,
    jackpot_port : 4203,
    cron_port: 4206,
	mysql : {
		host : 'localhost',
		user : 'root',
        password : '',
		database : 'jackpot'
    } ,
    ladder_rate : 1.95 ,
    //main_host_url : "http://157.230.252.135/"
    main_host_url : "http://localhost:7980/",
    origin_header: "http://157.230.252.135"
}

module.exports = config
