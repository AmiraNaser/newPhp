<?php 

require 'dbconnect.php';
require 'checklogin.php';

 $id  = $_GET['id'];

 $sql = "SELECT  image  FROM tasks where id = $id";

 $op   = mysqli_query($con,$sql);
 $data = mysqli_fetch_assoc($op);

 $sql = "DELETE FROM tasks where id = $id";

 $op = mysqli_query($con,$sql);


 if($op){

   unlink('./uploads/'.$data['image']);
   
    $Message =  'Raw Removed';
 }else{
    $Message = 'Error Try Again';
 }

  $_SESSION['Message'] = $Message;
   header("location: index.php");
?>
