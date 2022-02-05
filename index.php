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

$f3 = Base::instance();

$f3->route('GET /', function () {
    //echo "<h1>Hello, World!</h1>";

    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function ($f3) {
    //echo "<h1>Hello, World!</h1>";

    // if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_SESSION['name'] = $_POST['first-name']. " " . $_POST['last-name'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];


        //redirect user to next page
        $f3->reroute('profile');
    }

    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET|POST /profile', function ($f3) {
    //echo "<h1>Hello, World!</h1>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['biography'] = $_POST['biography'];

        //redirect user to next page
        $f3->reroute('interests');
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interests', function ($f3) {
    //echo "<h1>Hello, World!</h1>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['interests'])) {
            $_SESSION['interests'] = implode(", ", $_POST['interests']);
        }
        else{
            $_SESSION['interests'] = "None selected";
        }
        //redirect user to next page
        $f3->reroute('summary');
    }

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



