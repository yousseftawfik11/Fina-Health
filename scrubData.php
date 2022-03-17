<?php

function scrubBatchID($bID)
{
    $regex = '/^[A-Z]{2}[0-9]{3}$/';

    if(preg_match($regex , $bID))
       return 0;
    else 
       return 1;

}

function scrubDeliveryDate($date)
{
    $d = explode(".", $date);

    $day = $d[0];
    $month = $d[1];
    $year = $d[2];

    if(checkdate($month, $day, $year))
        return 0;
    else
        return 1;
}

function scrubNumericData($num)
{
    if(is_string($num)){

        if ( !is_numeric($num[0])) {
        
            $arr = preg_split('/(?<=[a-z])(?=[0-9]+)/i',$num); 
    
            return $arr[1];
        
        }
    } 
    else if(empty($num))
    {
            return 1;
    }
    else 
    {
            return 0;
    }
}

function scrubStringData($str)
{
    if(empty($str))
    {
        return 1;
    }
    else if (is_numeric($str[0])) 
    {
        $arr = preg_split('/(?=[a-z])/i', $str, 2);
        return $arr[1];
    }
    else 
    {
        return 0;
    }
}

?>