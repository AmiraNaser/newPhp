<?php 
function Sanitize($input, $flag = 0)
{
    $input =  trim($input);
    $input =  filter_var($input, FILTER_SANITIZE_STRING);
    return $input;
}

?>