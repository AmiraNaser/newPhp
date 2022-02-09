<?php
session_start();

# Sanitize validtion function
function Sanitize($input, $flag = 0) {
  $input = trim($input);
  if($flag == 0) {
    $input = filter_var($input, FILTER_SANITIZE_STRING);
  } 
  return $input;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
   
     $name     = Sanitize($_POST['name']);
     $password = Sanitize($_POST['password']);
     $email    = Sanitize($_POST['email'], 2);
     $address  = Sanitize($_POST['address']);
     $gender   = Sanitize($_POST['gender']);
     $url      = Sanitize($_POST['url']);
    # Validate ...... 
 
    $errors = []; 
 
    # validate name .... 
    if(empty($name)){
        $errors['Name'] = "Field Required"; 
    }
 
    # validate email 
    if(empty($email)){
        $errors['Email'] = "Field Required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors['Email']   = "Invalid Email";
    }
 
    # validate password 
    if(empty($password)){
        $errors['Password'] = "Field Required";
    }elseif(strlen($password) < 6){
        $errors['Password'] = "Length Must be >= 6 chars";
    }
    # validate gender
    if(empty($gender)) {
        $errors['gender'] = "Field Required";
    }
    # validate address
    if(empty($address)){
        $errors['Address'] = "Field Required";
    }elseif(strlen($password) > 10) {
        $errors['Address'] = "Length Must be >= 10 chars";
    }
    # validate url
    if(empty($url)) {
        $errors['Url'] = "Field Required";
    }elseif(!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors['Url'] = "Invalid URL";
    }
   # validate image
    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageType = $_FILES['image']['type'];
  
        $nameArray   = explode('.', $imageName);
        $imageExtension = strtolower(end($nameArray));
        $newImageName   = time().rand().'.'. $imageExtension;

        $extensions = ['png', 'jpg', 'jpeg'];
        if (in_array($imageExtension, $extensions)) {
            $imagePath = './images/'. $newImageName;
            if (move_uploaded_file($imageTemp, $imagePath)) {
              echo 'File Uploaded'.'</br>';
            }else {
              $errors['Profile Image'] = "Error uploading Image";
            }
        }else {
          $errors['Profile Image'] = "invalid extension";
        }
    }else {
      $errors['Profile Image'] = "Please select an image";
    }   
   # Check ...... 
   if(count($errors) > 0){
       // print errors .... 
 
     foreach ($errors as $key => $value) {
         echo '* '.$key.' : '.$value.'<br>';
     }

   }else{
       echo 'Valid Data .... ';
       $_SESSION['Message']  = "User Data: ";
       $_SESSION['UserData'] = ["name" => $name, "email" => $email, "address" => $address, "gender" => $gender, "url" => $url];
       $_SESSION['image']    = $imagePath;
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
      
        <form  action="<?php echo   htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" >

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
                <label for="exampleInputAddress">Address</label>
                <input type="text" class="form-control" id="exampleInputAddress"   name="address" placeholder="Your address">
            </div>

            <div class="form-group">
                <label for="exampleInputUrl">Linked URL</label>
                <input type="url" class="form-control" id="exampleInputUrl"   name="url" placeholder="Linked Url">
            </div>
            <div class="form-group">
                <label for="exampleInputGender">Gender</label>
                <input type="text" class="form-control" id="exampleInputGender"   name="gender" placeholder="Your Gender">
            </div>
            <div class="form-group">
                <label for="exampleInputImage">Gender</label>
                <input type="file" class="form-control" id="exampleInputImage"   name="image" placeholder="Your Profile Image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <br>


    <a href="action.php?id=20130&name=testAccount">Student Info</a>



</body>
</html>