var express = require('express');  
var app = express();  
var server = require('http').createServer(app);  
var mysql = require('mysql');
var config = require('../config');
var bodyParser = require('body-parser');
var cron = require('node-cron');

/* ======= connect to database =======*/
var con; 
function handleDisconnect() {
  con = mysql.createConnection(config.mysql);
  con.connect(function(err){
    if(err){
      console.log('error when connecting to db:' , err);
      setTimeout(handleDisconnect , 2000);
    }
  });
  con.on('error' ,  function(err){
    console.log('db error' , err);
    if(err.code == 'PROTOCOL_CONNECTION_LOST'){
      handleDisconnect();
    }else{
      throw err;
    }
  });
}
handleDisconnect();
//////////////////////////////
app.use(bodyParser.json());

/**
* clear jackpot game log
* @return: void
* @param: string
*/
function clearJackpotGameLog(formatted) {
    var query = "delete from jackpot_game where CREATE_TIME < " + formatted;
    con.query(query, function (err, result) {
        if (err) throw err;
    });
}

/**
* insert cron log 
* @return: void
* @param: void
*/
function insertCronLog() {
    var formatted = new Date();
    var date = formatted.toLocaleDateString();
    formatted = formatted.getTime();
    formatted = Math.round(formatted / 1000);
    var query = "INSERT INTO cron (CREATE_TIME, DATE)"; 
    query += " VALUES (" + formatted + " , '"+ date +"')";
    con.query(query, function (err, result) {
        if (err) throw err;
    });
}

/* ======= start of cron =======*/
cron.schedule('0 0 * * *', () => {
    console.log('running script every day');
    var d = new Date();
    d.setDate(d.getDate() - 2);
    d.setHours(0, 0 ,0);
    //console.log("3 days ago is: " , d.toLocaleDateString() , d.getTime());
    var formatted = d.getTime();
    formatted = Math.round(formatted / 1000);
    clearJackpotGameLog(formatted);
    insertCronLog();
});

server.listen(config.cron_port, function(){
    console.log('listening on *:' + config.cron_port);
});
