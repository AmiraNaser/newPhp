<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
   
     $name     = $_POST['name'];
     $password = $_POST['password'];
     $email    = $_POST['email'];
     $url      = $_POST['url'];
 
    # Validate ...... 
 
    $errors = []; 
 
    # validate name .... 
    if(empty($name)){
        $errors['name'] = "Field Required"; 
    }
 
    # validate email 
    if(empty($email)){
        $errors['email'] = "Field Required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors['Email']   = "Invalid Email";
    }
 
    # validate password 
    if(empty($password)){
        $errors['password'] = "Field Required";
    }elseif(strlen($password) < 6){
        $errors['Password'] = "Length Must be >= 6 chars";
    }
    # validate url
    if(empty($url)) {
        $errors['url'] = "Field Required";
    }elseif(!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors['Url'] = "Invalid URL";
    }
   # Check ...... 
   if(count($errors) > 0){
       // print errors .... 
 
     foreach ($errors as $key => $value) {
         echo '* '.$key.' : '.$value.'<br>';
     }

   }else{
       echo 'Valid Data .... ';
   }
}
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>
      
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  >

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1"   name="password" placeholder="Password">
            </div>


            <div class="form-group">
                <label for="exampleInputUrl">Linked URL</label>
                <input type="url" class="form-control" id="exampleInputUrl"   name="url" placeholder="Linked Url">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <br>


    <a href="action.php?id=20130&name=testAccount">Student Info</a>



</body>
</html>