<?php
function validName($name):bool
{
    return strlen($name) >= 1;
}

function validAge($age)
{
    return $age >= 18 && $age <= 118;
}

function validPhone($phone):bool
{
    return is_numeric($phone);
}

function validEmail($email):bool
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}


function validIndoor($interests):bool
{
    $validIndoor = indoorInterests();

    foreach($interests as $selection) {
        if (!in_array($selection, $validIndoor)) {
            return false;
        }
    }
    return true;
}


function validOutdoor($interests): bool
{
    $validOutdoor = outdoorInterests();

    foreach($interests as $selection) {
        if (!in_array($selection, $validOutdoor)) {
            return false;
        }
    }
    return true;
}
