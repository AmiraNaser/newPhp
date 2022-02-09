<?php
session_start();
if(count($_SESSION) > 0) {
    echo $_SESSION['Message'].'</br>';
    echo $_SESSION['UserData']['name'].'</br>';
    echo $_SESSION['UserData']['email'].'</br>';
    echo $_SESSION['UserData']['address'].'</br>';
    echo $_SESSION['UserData']['gender'].'</br>';
    echo $_SESSION['UserData']['url'].'</br>';
    // $image= file_get_contents($_SESSION['image']);
    // echo $image;
}else {
    echo 'No data available';
}
?>