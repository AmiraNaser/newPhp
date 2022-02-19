<?php
function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);   // <>>>>>
    }
    return $input;
}

function Check($input) {
    list($year, $month, $day) = explode('-', $input); 
    return checkdate($month, $day, $year);
}
?>