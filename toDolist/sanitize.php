<?php 
function Sanitize($input, $flag = 0)
{
    $input =  trim($input);
    $input =  filter_var($input, FILTER_SANITIZE_STRING);
    return $input;
}

function isValidDateTime($date)
{   
    $dateArray = explode('', $date);  
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-])$/", $dateArray, $matches)) 
    {     
        if (checkdate($matches[2],$matches[3], $matches[1])) {             
            return true;        
        }    
    }     
    return false; 
} 
?>