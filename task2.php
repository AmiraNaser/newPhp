<?php
$char = readline('Please Enter a character: ');
function nextChar ($char) {
    $nextChar = chr(ord($char) + 1);
    if ($nextChar == '{') {
         $nextChar = 'a';
    } elseif ($nextChar == '[') {
         $nextChar = 'A';
    }
    return $nextChar;
}
echo nextChar($char);
?>