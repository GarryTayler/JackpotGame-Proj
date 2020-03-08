/**
 * Module dependencies.
 */
let express, http, bodyParser, url, path;

express = require('express');
http = require('http');
url = require('url');
path = require('path');
bodyParser = require('body-parser');
let ejs = require('ejs');

require('./game/jackpot');
require('./chat');
