<?php
require 'dbconnect.php';
$id = $_GET['id'];
$sql = "delete from blog where id = $id";
$operation = mysqli_query($conn,$sql);

if($operation) {
    $Message = 'Raw Deleted';
}else {
    $Message = 'Somthing went wrong';
}

$_SESSION['Message'] = $Message;
header("location: index.php");
?>