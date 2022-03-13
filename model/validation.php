<?php

class Validation
{

//validates name
    static function validName($name): bool
    {
        return strlen($name) >= 1;
    }

//validate age
    static function validAge($age)
    {
        return $age >= 18 && $age <= 118;
    }

    //validate gender
    static function validGender($gender): bool
    {
        return strlen($gender) >= 1;
    }


//validates phone
    static function validPhone($phone): bool
    {
        return is_numeric($phone);
    }

//validates email
    static function validEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


//validates indoor interests
    static function validIndoor($interests): bool
    {
        $validIndoor = DataLayer::indoorInterests();

        foreach ($interests as $selection) {
            if (!in_array($selection, $validIndoor)) {
                return false;
            }
        }
        return true;
    }

//validates outdoor interests
    static function validOutdoor($interests): bool
    {
        $validOutdoor = DataLayer::outdoorInterests();

        foreach ($interests as $selection) {
            if (!in_array($selection, $validOutdoor)) {
                return false;
            }
        }
        return true;
    }
}
