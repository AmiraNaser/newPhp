<?php

require './blog.php';

$id = $_GET['id'];
$blog = new blog;
$result =  $blog->remove($id);

if($result){
    $_SESSION['Message'] = "Raw Removed";
}else{
    $_SESSION['Message'] = "Error Try Again";
}

header("location: index.php");




?>