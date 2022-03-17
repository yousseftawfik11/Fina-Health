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

function scrubNumericData($num)
{
    if(is_string($num)){

        if ( !is_numeric($num[0])) {
        
            $arr = preg_split('/(?<=[a-z])(?=[0-9]+)/i',$qty); 
    
            return $arr[1];
        
        }
    } 
    else if(empty($qty))
    {
            return 1;
    }
    else 
    {
            return null;
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
        $arr = preg_split('/(?=[a-z])/i', $name, 2);
        return $arr[1];
    }
    else 
    {
        return null;
    }
}

?>