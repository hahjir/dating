<?php

class Control
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
        $_SESSION = array();

        $first = "";
        $last = "";
        $age = "";
        $phone = "";


        //if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['premium'])) {
                $member = new PremiumMember();
            } else {
                $member = new Member();
            }

            $first = $_POST['first-name'];
            $last = $_POST['last-name'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];



            if (Validation::validName($first)) {
                $member->setFirst($_POST['first-name']);
                /*
                $_SESSION['name'] = $_POST['first-name'];
                $_SESSION['first-name'] = $_POST['first-name'];
                */


            } else {
                $this->_f3->set('errors["first-name"]', 'Please enter first name');
            }


            if (Validation::validName($last)) {
                $member->setLast($_POST['last-name']);
                /*
                $_SESSION['name'] .= " " . $_POST['last-name'];
                $_SESSION['last-name'] = $_POST['last-name'];
                */

            } else {
                $this->_f3->set('errors["last-name"]', 'Please enter last name');
            }

            if (Validation::validAge($age)) {
                $member->setAge($_POST['age']);
                /*
                  $_SESSION['age'] = $_POST['age'];
                */


            } else {
                $this->_f3->set('errors["age"]', 'Please enter age between 18 and 118');
            }

            if (Validation::validPhone($phone)) {
                $member->setPhone($_POST['phone']);
                /*
                $_SESSION['phone'] = $_POST['phone'];
                */


            } else {
                $this->_f3->set('errors["phone"]', 'Please enter a valid phone number');
            }

            /*
            if (Validation::validGender($gender)) {
                $_SESSION['gender']->setGender($gender);
            } else {
                $this->_f3->set('errors["gender"]', 'Please enter gender');
            }
             */

            $member->setGender($_POST['gender']);


            if (empty($this->_f3->get('errors'))) {
                $_SESSION['member'] = $member;
                $this->_f3->reroute('profile');
            }
        }

        $this->_f3->set('first', $first);
        $this->_f3->set('last', $last);
        $this->_f3->set('age', $age);
        $this->_f3->set('phone', $phone);


        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $member = $_SESSION['member'];
            if (Validation::validEmail($_POST['email'])) {
                $member->setEmail($_POST['email']);
            } else {
                $this->_f3->set('errors["email"]', 'Please enter a valid email');
            }


            $member->setState($_POST['state']);
            $member->setSeeking($_POST['seeking']);
            $member->setBio($_POST['biography']);


            //redirect user to next page
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['member'] = $member;
                if ($member instanceof PremiumMember) {
                    $this->_f3->reroute('interests');
                } else {
                    $this->_f3->reroute('summary');
                }
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $interest = $_POST['interests'];
            $member = $_SESSION['member'];

            if (!empty($_POST['indoor'])) {

                if (Validation::validIndoor($_POST['indoor'])) {
                    $indoor = (implode(" , ", $_POST['indoor']));
                    $member->setIndoorInterest($indoor);
                    /*
                    $_SESSION['indoor'] = $_POST['indoor'];
                    */
                } else {
                    $this->_f3->set('errors["indoor"]', 'Please enter a valid indoor interest');
                }
            }

            if (!empty($_POST['outdoor'])) {

                if (Validation::validOutdoor($_POST['outdoor'])) {
                    $member->setOutdoorInterest(implode(" , ", $_POST['outdoor']));
                    /*
                    $_SESSION['outdoor'] = $_POST['outdoor'];
                    */
                } else {
                    $this->_f3->set('errors["outdoor"]', 'Please enter a valid outdoor interest');
                }
            }


            if (empty($this->_f3->get('errors'))) {

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

    }

}

