<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../pdo-config.php';

class DataLayer
{

    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $dbh
     */


    function __construct()
    {
        //require database credentials
        try {
            //Instantiate a PDO database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch (PDOException $e) {
            echo "Error connecting to DB " . $e->getMessage();
        }
    }

    function insertMember($member)
    {
        $sql = "INSERT INTO member(first, last, age, gender, phone, email, state, seeking, bio, premium, interests)
            VALUES (:first, :last, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        if (get_class($member) == "PremiumMember") {

            $interests = "";
            $premium = 1;


            if ($member->getIndoorInterests() != null) {
                $interests .= $member->getIndoorInterests();
            }

            if ($member->getIndoorInterests() != null && $member->getOutdoorInterests() != null) {
                $interests .= ", " . $member->getOutdoorInterests();
            } else {
                $interests .= $member->getOutdoorInterests();
            }

            if ($interests == "") {
                $interests = "None";
            }


            $first = $member->getFirst();
            $last = $member->getLast();
            $age = $member->getAge();
            $gender = $member->getGender();
            $phone = $member->getPhone();
            $email = $member->getEmail();
            $state = $member->getState();
            $seeking = $member->getSeeking();
            $bio = $member->getBio();


            // bind parameters
            $statement->bindParam(':first', $first);
            $statement->bindParam(':last', $last);
            $statement->bindParam(':age', $age);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':seeking', $seeking);
            $statement->bindParam(':bio', $bio);
            $statement->bindParam(':premium', $premium);
            $statement->bindParam(':interests', $interests);


        } else {
            $premium = 0;
            $interests = "";


            $first = $member->getFirst();
            $last = $member->getLast();
            $age = $member->getAge();
            $gender = $member->getGender();
            $phone = $member->getPhone();
            $email = $member->getEmail();
            $state = $member->getState();
            $seeking = $member->getSeeking();
            $bio = $member->getBio();


            // bind parameters
            $statement->bindParam(':first', $first);
            $statement->bindParam(':last', $last);
            $statement->bindParam(':age', $age);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':seeking', $seeking);
            $statement->bindParam(':bio', $bio);
            $statement->bindParam(':premium', $premium);
            $statement->bindParam(':interests', $interests);

        }
        //4. Execute the query
        $statement->execute();

    }


    function getMembers()
    {
        //1. Define the query
        $sql = "SELECT * FROM member";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMember($member_id)
    {
        //1. Define the query
        $sql = "SELECT * FROM member";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);


        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getInterests($member_id)
    {
        //1. Define the query
        $sql = "SELECT * FROM member";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);


        //4. Execute the query
        $statement->execute();

        //5. Process the results (get the primary key)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    static function indoorInterests()
    {
        return array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games');
    }


    static function outdoorInterests()
    {
        return array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');
    }
}


