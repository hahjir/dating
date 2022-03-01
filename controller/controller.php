<?php

class Controller
{
    private $_f3; //F3 object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {

        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personal()
    {
        $first = "";
        $last = "";
        $age = "";
        $phone = "";
        $gender = "";

        //if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first = $_POST['first-name'];
            $last = $_POST['last-name'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];

            if (validName($first)) {
                $_SESSION['name'] = $_POST['first-name'];
                $_SESSION['first-name'] = $_POST['first-name'];

            } else {
                $this->_f3->set('errors["first-name"]', 'Please enter first name');
            }


            if (validName($last)) {
                $_SESSION['name'] .= " " . $_POST['last-name'];
                $_SESSION['last-name'] = $_POST['last-name'];
            } else {
                $this->_f3->set('errors["last-name"]', 'Please enter last name');
            }

            if (Validator::validAge($age)) {
                $_SESSION['age'] = $_POST['age'];
            } else {
                $this->_f3->set('errors["age"]', 'Please enter age between 18 and 118');
            }

            if (Validator::validPhone($phone)) {
                $_SESSION['phone'] = $_POST['phone'];
            } else {
                $this->_f3->set('errors["phone"]', 'Please enter a valid phone number');
            }

            if (Validator::validAge($gender)) {
                $_SESSION['gender'] = $_POST['gender'];
            } else {
                $this->_f3->set('errors["gender"]', 'Please enter gender');
            }

            // $_SESSION['gender'] = $_POST['gender'];


            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('profile');
            }
        }

        $this->_f3->set('first', $first);
        $this->_f3->set('last', $last);
        $this->_f3->set('age', $age);
        $this->_f3->set('phone', $phone);
        $this->_f3->set('gender', $gender);

        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (Validator::validEmail($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
            } else {
                $this->_f3->set('errors["email"]', 'Please enter a valid email');
            }

            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['biography'] = $_POST['biography'];

            //redirect user to next page
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('interests');
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $interest = $_POST['interests'];

            if (!empty($_POST['indoor'])) {

                if (Validator::validIndoor($_POST['indoor'])) {
                    $_SESSION['indoor'] = $_POST['indoor'];
                } else {
                    $this->_f3->set('errors["indoor"]', 'Please enter a valid indoor interest');
                }
            }

            if (!empty($_POST['outdoor'])) {

                if (Validator::validOutdoor($_POST['outdoor'])) {
                    $_SESSION['outdoor'] = $_POST['outdoor'];
                } else {
                    $this->_f3->set('errors["outdoor"]', 'Please enter a valid outdoor interest');
                }
            }


            if (empty($this->_f3->get('errors'))) {
                if (!empty($_SESSION['indoor']) and !empty($_SESSION['outdoor'])) {

                    $_SESSION['combined'] = array_merge($_SESSION['outdoor'], $_SESSION['indoor']);

                    $_SESSION['interests'] = implode(", ", $_SESSION['combined']);


                } else if (!empty ($_SESSION['indoor'])) {
                    $_SESSION['interests'] = implode(" , ", $_SESSION['indoor']);


                } else if (!empty ($_SESSION['outdoor'])) {
                    $_SESSION['interests'] = implode(" , ", $_SESSION['outdoor']);


                } else {
                    $_SESSION['interests'] = "None selected";
                }
                $this->_f3->reroute('summary');
            }
        }

        $this->_f3->set('userIndoors', DataLayer::indoorInterests());
        $this->_f3->set('userOutdoors', DataLayer::outdoorInterests());
        //$f3->set('interests', $interest);

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');

        //Clear the session data
        session_destroy();
    }

}

