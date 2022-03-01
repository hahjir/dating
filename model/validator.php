<?php

class Validator
{

//validates name
    function validName($name): bool
    {
        return strlen($name) >= 1;
    }

//validate age
    function validAge($age)
    {
        return $age >= 18 && $age <= 118;
    }

//validates phone
    function validPhone($phone): bool
    {
        return is_numeric($phone);
    }

//validates email
    function validEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


//validates indoor interests
    function validIndoor($interests): bool
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
    function validOutdoor($interests): bool
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
