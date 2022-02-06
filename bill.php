<?php
$unit = 50;

if($unit <= 50) {
    echo($unit * 3.5);
} elseif ($unit > 50 && $unit <=150) {
    echo($unit * 4);
}elseif ($unit > 150) {
 echo($unit * 6.50);   
}
?>
