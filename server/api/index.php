<?php

//header("Content-Type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTION');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Acces-Control-Request-Method, Access-Control-Request-Headers, Access-Control-Allow-Origin, Authorization');


include_once('config/config.php');
include_once('autoloader.php');

Router::start();