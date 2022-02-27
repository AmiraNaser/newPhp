<?php 
session_start();

require 'functions.php';
require 'dbconnect.php';


class blog{


    private $title;
    private $content;
    private $image; 
    private $result = null;

    public function register($data){
     $validator = new Validator;

     $this->title     = $validator->Clean($data['title']); 
     $this->content   = $validator->Clean($data['content']);

     $errors = [];

     if(!$validator->validate($this->title,1)){
        $errors['title'] = "Field Required";
     }elseif(!$validator->validate($this->title,4)){
        $errors['title'] = "Invalid Title";
     }

     if(!$validator->validate($this->content,1)){
        $errors['content'] = "Field Required";
     }elseif(!$validator->validate($this->content,2)){
        $errors['content'] = "Invalid Content Length";
     }
     if(!$validator->validate($this->image = $_FILES['image']['name'],1)){
        $errors['image'] = "Field Required";
     }elseif(!$validator->validate($this->image = $_FILES['image']['name'],3)){
        $errors['image'] = "Invalid Image";
     }


     if(count($errors) > 0 ){

        $this->result = $errors;
    }else {

    $image = uploadFile($_FILES);

    if (empty($image) ) {
      $this->result = ["Error In Uploading File Try Again"];
    }else{
       $dbObj = new DB;

       $sql = "insert into user (title,content,image) values ('$this->title','$this->content','$this->image')";
      
       $op = $dbObj->doQuery($sql); 
        
       if($op){
           $this->result = ["Success" => "data Inserted"];
       }else{
        $this->result = ["Error" => "Error Try Again"];
       }
       
    }
    
  } 
  return $this->result;
}


    public function showData(){

      $dbObj = new DB;

      $sql = "select * from user"; 

      $result = $dbObj->doQuerySelect($sql);

      return $result;

    }


    public function remove($id){

      $dbObj = new DB;

      $sql = "delete from user where id = $id"; 

      $this->result = $dbObj->doQuery($sql); 
        
        return $this->result; 

    }

    public function edit($data){
        $validator = new Validator;

        $this->title     = $validator->Clean($data['title']); 
        $this->content   = $validator->Clean($data['content']);
   
        $errors = [];
   
        if(!$validator->validate($this->title,1)){
           $errors['title'] = "Field Required";
        }elseif(!$validator->validate($this->title,4)){
           $errors['title'] = "Invalid Title";
        }
   
        if(!$validator->validate($this->content,1)){
           $errors['content'] = "Field Required";
        }elseif(!$validator->validate($this->content,2)){
           $errors['content'] = "Invalid Content Length";
        }
        if(!$validator->validate($this->image = $_FILES['image']['name'],1)){
           $errors['image'] = "Field Required";
        }elseif(!$validator->validate($this->image = $_FILES['image']['name'],3)){
           $errors['image'] = "Invalid Image";
        }
   
   
        if(count($errors) > 0 ){
   
           $this->result = $errors;
       }else {
       $image = uploadFile($_FILES);
   
       if (empty($image) ) {
          $this->result = ["Error In Uploading File Try Again"];
       }else{
          $dbObj = new DB;
   
          $sql = "update user set title = '$title' , content = '$content', image = '$image' where  id = $id";
         
          $op = $dbObj->doQuery($sql); 
           
          if($op){
              $this->result = ["Success" => "data Updated"];
          }else{
           $this->result = ["Error" => "Error Try Again"];
          }
          return $this->result;
       }
   
     } 
    }

}


?>