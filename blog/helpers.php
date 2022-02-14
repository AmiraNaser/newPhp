<?php 

function Sanitize($input)
{

    $input =  trim($input);
    $input =  filter_var($input, FILTER_SANITIZE_STRING);
    
    return $input;
}


?>