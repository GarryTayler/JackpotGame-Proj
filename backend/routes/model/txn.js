var db = require('./../../utils/database')
exports.insertTxn = function (insertData, callback) {
    var timestamp = Math.floor(Date.now() / 1000);
    var amount_coins = parseInt(Math.pow(10 , 6) * insertData.amount);
    var insertQuery =
    "INSERT INTO deposit_withdraw_log ( " +
    " `USER_ID`, " +
    "`TYPE`, " +
    "`AMOUNT_BTC`, " +
    "`AMOUNT_COINS`, " +
    "`FEE`, " +
    "`DETAIL`, " +
    "`TXHASH`, " +
    "`STATUS`, " +
    "`CREATE_TIME`, " +
    "`UPDATE_TIME`) " +
    "VALUES ('" +
    insertData.who + "', '" +
    insertData.type + "', '" +
    insertData.amount + "', '" +
    amount_coins + "', '" +
    insertData.fees + "', '" +
    insertData.detail + "', '" +
    insertData.txhash + "', 0 , " +
    timestamp + ", " +
    timestamp + ")";
    db.con.query(insertQuery, function (err, rows, fields) {
        if (err) {
            return callback(err, null);
        }
        var return_data = {
            res: true,
            content: rows
        }
        return callback(null, return_data);
    });
}

exports.checkFirstDeposit = function(user_id) {
    var query = "SELECT * " +
    "FROM deposit_withdraw_log " +
    "WHERE USER_ID = " + user_id +
    " AND `TYPE` = 1 ";

    return new Promise((resolve , reject) => {
        db.con.query(query , function(err , result , fields) {
            if(err)
                reject(err);
            else {
                result = JSON.stringify(result);
                result = JSON.parse(result);
                if(result.length < 2)
                    resolve(true)
                else
                    resolve(false)
            }
        });
    });
}

exports.confirmWithdraw = function(who , withdraw_id) {
    return new Promise((resolve , reject) => {
        /* Begin transaction */
        db.con.getConnection(function(err , conn) {
            if(err)
                reject(err);
            else {
                conn.beginTransaction(function(err) {
                    if(err)
                        reject(err);
                    else {
                        conn.query("select * from deposit_withdraw_log where ID = " + withdraw_id , function(err , result , fields) {
                            if(err) {
                                reject(err);
                            }
                            else {
                                result = JSON.stringify(result);
                                result = JSON.parse(result);
                                var withdrawal_amount = parseInt(result[0].AMOUNT_COINS + result[0].FEE * Math.pow(10 , 6))
                                conn.query("UPDATE users SET WALLET_BLOCK = WALLET_BLOCK - " + withdrawal_amount + " WHERE ID = " + who, function(err , result) {
                                    if(err) {
                                        conn.rollback(function() {
                                            reject(err);
                                        });
                                    }
                                    else {
                                        conn.query("UPDATE deposit_withdraw_log SET STATUS = 1 WHERE ID = " + withdraw_id , function(err , result) {
                                            if(err) {
                                                conn.rollback(function() {
                                                    reject(err);
                                                });
                                            }
                                            else {
                                                conn.commit(function(err) {
                                                    if (err) {
                                                        conn.rollback(function() {
                                                            reject(err);
                                                        });
                                                    }
                                                    else {
                                                        conn.end();
                                                        resolve(true);
                                                    }
                                                });
                                            }
                                        })
                                    }
                                });
                            }
                        })
                    }
                })
            }
        });
    })
}

exports.requestWithdraw = function(who, amount, amount_coins, to_address, fee) {
    return new Promise((resolve , reject) => {
        /* Begin transaction */
        db.con.getConnection(function(err , conn) {
            if(err)
                reject(err);
            else {
                conn.beginTransaction(function(err) {
                    if(err)
                        reject(err);
                    else {
                        conn.query("UPDATE users SET WALLET = WALLET - " + amount_coins + ", WALLET_BLOCK = WALLET_BLOCK + " + amount_coins + " WHERE ID = " + who, function(err , result) {
                            if(err) {
                                conn.rollback(function() {
                                    reject(err);
                                });
                            }
                            else {
                                var timestamp = Math.floor(Date.now() / 1000);
                                var real_amount_btc = amount - fee;
                                var real_amount_coins = parseInt(real_amount_btc * Math.pow(10, 6));
                                var insertQuery =
                                    "INSERT INTO deposit_withdraw_log ( " +
                                    " `USER_ID`, " +
                                    "`TYPE`, " +
                                    "`AMOUNT_BTC`, " +
                                    "`AMOUNT_COINS`, " +
                                    "`FEE`, " +
                                    "`DETAIL`, " +
                                    "`TXHASH`, " +
                                    "`STATUS`, " +
                                    "`CREATE_TIME`, " +
                                    "`UPDATE_TIME`) " +
                                    "VALUES ('" +
                                    who + "', " +
                                    "'2', " +
                                    "'" + real_amount_btc + "', " +
                                    "'" + real_amount_coins + "', " +
                                    "'" + fee + "', " +
                                    "'" + to_address + "', " +
                                    "'" + to_address + "', " +
                                    "0 , " +
                                    timestamp + ", " +
                                    timestamp + ")";
                                    conn.query(insertQuery , function(err , result) {
                                    if(err) {
                                        conn.rollback(function() {
                                            reject(err);
                                        })
                                    }
                                    else {
                                        conn.commit(function(err) {
                                            if (err) {
                                                conn.rollback(function() {
                                                    reject(err);
                                                });
                                            }
                                            else {
                                                conn.end();
                                                resolve(true);
                                            }
                                        });
                                    }
                                })
                            }
                        });
                    }
                });
            }
        })
    });
}

