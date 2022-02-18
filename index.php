<?php

//This is my CONTROLLER

//Turn on output buffering
ob_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

//start the session
session_start();
//var_dump($_SESSION);

require_once('vendor/autoload.php');
require('model/data-layer.php');
require('model/validation-function.php');

$f3 = Base::instance();

$f3->route('GET /', function () {
    //echo "<h1>Hello, World!</h1>";

    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function ($f3) {
    $first = "";
    $last = "";
    $age = "";
    $phone = "";

//if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first = $_POST['first-name'];
        $last = $_POST['last-name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];

        if(validName($first)){
            $_SESSION['name'] = $_POST['first-name'];
            $_SESSION['first-name'] = $_POST['first-name'];

        }
        else{
            $f3->set('errors["first-name"]', 'Please enter first name');
        }


        if(validName($last)){
            $_SESSION['name'].=  " " . $_POST['last-name'];
            $_SESSION['last-name'] = $_POST['last-name'];
        }
        else{
            $f3->set('errors["last-name"]', 'Please enter last name');
        }

        if(validAge($age)){
            $_SESSION['age'] = $_POST['age'];
        }
        else{
            $f3->set('errors["age"]', 'Please enter age between 18 and 118');
        }

        if(validPhone($phone)){
            $_SESSION['phone'] = $_POST['phone'];
        }
        else{
            $f3->set('errors["phone"]', 'Please enter a valid phone number');
        }

        $_SESSION['gender'] = $_POST['gender'];



        if(empty($f3->get('errors'))){
            $f3->reroute('profile');
        }
    }

    $f3->set('first', $first);
    $f3->set('last', $last);
    $f3->set('age', $age);
    $f3->set('phone', $phone);
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});


$f3->route('GET|POST /profile', function ($f3) {
    //echo "<h1>Hello, World!</h1>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (validEmail($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
        } else {
            $f3->set('errors["email"]', 'Please enter a valid email');
        }

        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['biography'] = $_POST['biography'];

        //redirect user to next page
        if (empty($f3->get('errors'))) {
            $f3->reroute('interests');
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interests', function ($f3) {
    //echo "<h1>Hello, World!</h1>";
    //$interest = "";


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // $interest = $_POST['interests'];

        if(!empty($_POST['indoor'])) {

            if (validIndoor($_POST['indoor'])) {
                $_SESSION['indoor'] = $_POST['indoor'];
            } else {
                $f3->set('errors["indoor"]', 'Please enter a valid indoor interest');
            }
        }

        if(!empty($_POST['outdoor'])) {

            if (validOutdoor($_POST['outdoor'])) {
                $_SESSION['outdoor'] = $_POST['outdoor'];
            } else {
                $f3->set('errors["outdoor"]', 'Please enter a valid outdoor interest');
            }
        }


        if (empty($f3->get('errors'))) {
            if (!empty($_SESSION['indoor']) and !empty($_SESSION['outdoor'])) {

                $_SESSION['combined'] = array_merge($_SESSION['outdoor'] , $_SESSION['indoor']);

                $_SESSION['interests'] = implode(", ", $_SESSION['combined']);



            }  else if (!empty ($_SESSION['indoor'] )) {
                $_SESSION['interests'] = implode (" , " ,$_SESSION['indoor']);



            }  else if (!empty ($_SESSION['outdoor'])) {
                $_SESSION['interests'] = implode (" , ",$_SESSION['outdoor']);


            } else {
                $_SESSION['interests'] = "None selected";
            }
            $f3->reroute('summary');
        }
    }

    $f3->set('userIndoors', indoorInterests());
    $f3->set('userOutdoors', outdoorInterests());
    //$f3->set('interests', $interest);

    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3->route('GET /summary', function () {
    //echo "<h1>Hello, World!</h1>";

    $view = new Template();
    echo $view->render('views/summary.html');

    // clear the session data
    session_destroy();
});


$f3->run();
//Send output to the browser
ob_flush();



