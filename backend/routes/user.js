var express = require('express');
var router = express.Router();
var model = require('./model/user');
var variableModel = require('./model/variable');
var txnModel = require('./model/txn');
var config = require('../config');

var rn = require('random-number');
var request = require('request');
var nodemailer = require('nodemailer');

router.post('/get_user_referralcode' , async function (req, res) {
    try {
      const referral_value = await variableModel.getReferralPercentage();
      const referral_code = await model.getReferralCode(req.body.user_id);
      const referral_link = config.MAIN_REFERRAL_PREFIX + "?r=" + referral_code;
      return res.json({
        code: 20000,
        message: null,
        status: 'success',
        data: {
          referral_value : referral_value,
          referral_code : referral_code,
          referral_link : referral_link
        }
      })
    } catch (err) {
      return res.json({
        code: 401,
        message: 'Api Request Failed.',
        status: 'fail',
        data: null
      })
    }
});
module.exports = router;
