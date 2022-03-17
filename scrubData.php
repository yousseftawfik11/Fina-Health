<?php

function scrubBatchID($bID)
{
    $regex = '/^[A-Z]{2}[0-9]{3}$/';

    if(preg_match($regex , $bID))
       return true;
    else 
       return false;

}

function scrubDeliveryDate($date)
{
    $d = explode(".", $date);

    $day = $d[0];
    $month = $d[1];
    $year = $d[2];

    if(checkdate($month, $day, $year))
        return true;
    else
        return false;
}

function scrubNumericData($bID)
{
    echo "hallo";
}

?>