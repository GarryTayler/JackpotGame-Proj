var path = require('path');
var main_port = 3001
var base_domain = "localhost"
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
    main_host_url : "http://localhost:7980/",

    BTC_SITE_WALLET_ADDRESS : "19ejNRyHmqgotgztP7XeLsXbHD7K5tkTJo",
    BTC_SITE_PRIVATE_KEY : "fb422f196446b71f851240984d92baa2fc229f9fdf71335a68db161cebe75ac9",
    BTC_SITE_PUBLIC_KEY : "0284673d7f6b73990999cf16cf03394069e1bca2b8536213ee3e23b50e7fb71b1c",
    BLOCKCYPHER_TOKEN : "f00484c44b6c457abf570448470af78c",

    BLOCKCYPHER_CALLBACK_HOST_URL : "http://" + base_domain + ":" + main_port + "/",
    BTC_withdraw_fee: 0.00005,
    BTC_min_withdraw_amount: 0.0001,

    EMAIL: 'no-reply@bitcrash.co.za',
    EMAIL_PWD: 'Rpy@2010!#_',
    EMAIL_REQUEST: 'https://cryptoonline.ml:3001/api/user/forgot_user_password'
}

module.exports = config
