<?php
require 'dbconnect.php';
require 'helpers.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password'], 1);
    $errors = [];
    if(empty($name)) {
        $errors['Name'] = 'Filed Required';
    }
    if(empty($email)) {
        $errors['Email'] = 'Filed Required';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = 'Invalid Email';
    }
    if(empty($password)) {
        $errors['Password'] = 'Filed Required';
    }elseif(strlen($password) < 6) {
        $errors['Password'] = 'Invalid Password length';
    }

    if (count($errors) > 0) {
        foreach($errors as $key => $value) {
            echo '*' . $key . ':' . $value . '</br>';
        }
    }else {
            $password = md5($password);

            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email','$password')";
            $op  = mysqli_query($con, $sql);
            mysqli_close($con);

            if ($op) {
                echo 'Raw Inserted';
                header("Location: login.php");
            }else {
                echo 'Error try again';
            }
        
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method= "post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
            </div>



            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>