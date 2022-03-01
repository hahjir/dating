<?php

//This is my CONTROLLER

//Turn on output buffering
ob_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

//start the session
session_start();
//var_dump($_SESSION);

$f3 = Base::instance();
$con = new Controller($f3);


//require('model/data-layer.php');
//require('model/validation-function.php');


$f3->route('GET /', function () {
    $GLOBALS['con']->home();

});

$f3->route('GET|POST /personal', function ($f3) {
    $GLOBALS['con']->personal();
});


$f3->route('GET|POST /profile', function ($f3) {
    $GLOBALS['con']->profile();
});


$f3->route('GET|POST /interests', function ($f3) {
    $GLOBALS['con']->interests();
});

$f3->route('GET /summary', function () {

    $GLOBALS['con']->summary();

    // clear the session data
    session_destroy();
});


$f3->run();
//Send output to the browser
ob_flush();


