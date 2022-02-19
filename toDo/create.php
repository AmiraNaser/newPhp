<?php
require 'dbconnect.php';
require 'helpers.php';

$user_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title    = Clean($_POST['title']);
    $content  = Clean($_POST['content']);
    $sDate    = $_POST['sDate'];
    $eDate    = $_POST['eDate'];

    //validate
    $errors   = [];
    if(empty($title)) {
        $errors['Title'] = 'Filed Required';
    }
    if(empty($content)) {
        $errors['Content'] = 'Filed Required';
    }
    if(empty($sDate)) {
        $errors['sDate'] = 'Filed Required';
    }elseif(!Check($sDate)) {
        $errors['sDate'] = 'Invalid Date';
    }
    if(empty($eDate)) {
        $errors['eDate'] = 'Filed Required';
    }elseif(!Check($eDate)) {
        $errors['eDate'] = 'Invalid Date';
    }      
    if(empty($_FILES['image']['name'])) {
        $errors['Image'] = 'Field Required';
    }else {
        $imgName = $_FILES['image']['name'];
        $imgTemp = $_FILES['image']['tmp_name'];
        $imgType = $_FILES['image']['type'];

        $nameArray    = explode('.', $imgName);
        $imgExtension = strtolower(end($nameArray));
        $imgFinalName = time() . rand() . $imgExtension;
        $allowedExt   = ['jpg', 'png', 'jpeg'];

        if (!in_array($imgExtension, $allowedExt)) {
            $errors['Image'] = 'Not allowed Extension';
        }
    }
    if (count($errors) > 0) {
        foreach($errors as $key => $value) {
            echo '*' . $key . ':' . $value . '</br>';
        }
    }else {
        $disPath = 'uploads/' . $imgFinalName;
        if (move_uploaded_file($imgTemp, $disPath)) {
            
            $sql = "INSERT INTO tasks (title, content, sDate, eDate, image, user_id) VALUES ('$title', '$content','$sDate', '$eDate','$imgFinalName', $user_id)";
            $op  = mysqli_query($con, $sql);
            mysqli_close($con);

            if ($op) {
                echo 'Raw Inserted';
                header("Location: index.php?id=$user_id");
            }else {
                echo 'Error try again';
            }
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h2> <a href="index.php?id=<?php echo $user_id;?>">Display Tasks</a> </h2> OR <h2>Create Task</h2>

        <form action="" method= "post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle"><Title></Title></label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title" placeholder="Enter Task Title">
            </div>



            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" required id="exampleInputContent" aria-describedby="" name="content" placeholder="Enter content">
            </div>
            <div class="form-group">
                <label for="exampleInputSDate">Start Date</label>
                <input type="date" class="form-control" required id="exampleInputSDate" name="sDate" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEDate">New Password</label>
                <input type="date" class="form-control" required id="exampleInputEDate" name="eDate" placeholder="">
            </div>                        
            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>