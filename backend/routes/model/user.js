var db = require('./../../utils/database')
var config = require('./../../config')
var updateBalance = function (updateData , callback) {
    var amount = updateData.amount * Math.pow(10 , 6);
    var updateQuery = "UPDATE users SET `WALLET`=`WALLET`+" + amount + " WHERE ID=" + updateData.who;
    db.con.query(updateQuery, function (err, rows, fields) {
        if(err) {
            return callback(err, null)
        } else {
            var return_data = {
                res: true,
                content: rows
            }
            return callback(null, return_data);
        }
    })
}

var getParentReferralCode = function(user_id) {
    var query = "SELECT REFERRAL_CODE_P , REFERRAL_CODE FROM users WHERE ID=" + user_id;
    return new Promise((resolve , reject) => {
        db.con.query(query , function(err , result , fields) {
            if(err)
                reject(err);
            else {
                result = JSON.stringify(result);
                result = JSON.parse(result);
                resolve(result[0])
            }
        });
    });
}

var getUseridByParentReferralCode = function(referral_code_p) {
    var query = "SELECT ID FROM users WHERE REFERRAL_CODE='" + referral_code_p + "'";
    return new Promise((resolve , reject) => {
        db.con.query(query , function(err , result , fields) {
            if(err)
                reject(err);
            else {
                result = JSON.stringify(result);
                result = JSON.parse(result);
                resolve(result[0]['ID'])
            }
        });
    });
}

var updateUserBalance = function (updateData) {
    var updateQuery = "UPDATE users SET `WALLET`=`WALLET`+" + updateData.amount + " WHERE ID=" + updateData.who;
    return new Promise((resolve , reject) => {
        db.con.query(updateQuery , function(err , result) {
            if(err)
                reject(err)
            else
                resolve(true)
        })
    })
}

var updateAdminBalance = function (updateData) {
    var updateQuery = "UPDATE admin SET `REFERRAL_WALLET`=`REFERRAL_WALLET`+" + updateData.amount + " WHERE ID=" + updateData.who;
    return new Promise((resolve , reject) => {
        db.con.query(updateQuery , function(err , result) {
            if(err)
                reject(err)
            else
                resolve(true)
        })
    })
}

var getUserBalance = function(keyData, callback) {
    var query = "SELECT `WALLET` FROM users WHERE ID=" + keyData.who;
    db.con.query(query, function (err, rows, fields) {
        if (err) {
            return callback(err, null);
        }else{
            var return_data = {
                res: true,
                content: rows[0]
            }
            return callback(null, return_data);
        }
    });
}

var userModel = {
    updateBalance: updateBalance,
    getUserBalance: getUserBalance,
    updateAdminBalance: updateAdminBalance,
    updateUserBalance: updateUserBalance,
    getParentReferralCode: getParentReferralCode,
    getUseridByParentReferralCode: getUseridByParentReferralCode
}

module.exports = userModel;