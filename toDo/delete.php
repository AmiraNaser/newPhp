<?php 

require 'dbconnect.php';

 $id = $_GET['id'];
 
 $sql = "select image  from tasks where id = $id";

 $op   = mysqli_query($con,$sql);
 $data = mysqli_fetch_assoc($op);


 $sql = "delete from tasks where id = $id";

 $op = mysqli_query($con,$sql);


 if($op){

   unlink('./images/'.$data['image']);
   
    $Message =  'Item Removed';
 }else{
    $Message = 'Error Try Again';
 }

  $_SESSION['Message'] = $Message;


   header("location: index.php");


?>