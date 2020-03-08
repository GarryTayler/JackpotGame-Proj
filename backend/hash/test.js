var ChanceJS = require("chance"); 
var engine = require('./hash_lib');
var connect = engine.connect;
var server_seed = '' , mod;

connect.query("select HASH from jackpot_game_hashes limit 0 , 1000" , function(err , result , fields) {
    if(err)
        throw err;
    result = JSON.stringify(result);
    result = JSON.parse(result);
    for( i = 0; i < result.length; i ++ ) {
        server_seed = result[i]['HASH'];
        mod = server_seed;
        var chance = new ChanceJS(mod); 
        var sum = 90.92;
        var percentage = ((chance.floating({min: 0, max: 100, fixed: 6}))/100);
        var ticket = sum * percentage;
        console.log(percentage , ticket);
    }
});







