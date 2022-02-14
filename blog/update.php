<?php
require 'dbconnect.php';
require 'helpers.php';

$id = $_GET['id'];
$sql = "select id,title,content,date from blog where id = $id";
$operation  = mysqli_query($conn,$sql);

$data= mysqli_fetch_assoc($operation); 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Sanitize($_POST['title']);
    $content   = Sanitize($_POST['content']);
    $date      = Sanitize($_POST['date']);

    # Validate ...... 

    $errors = [];

 
    # validate title .... 
    if(empty($title)){
        $errors['Title'] = "Title is Required";
    }
 
     # validate content 
     if(empty($content)){
         $errors['Content'] = "Content is Required";
     }elseif(strlen($content) < 50){
        $errors['Content']   = "Invalid Content Length";
     }
 
     # validate date 
     if(empty($date)){
         $errors['Date'] = "Date is  Required";
     }
       # validate image
       if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageType = $_FILES['image']['type'];
 
        $nameArray   = explode('.', $imageName);
        $imageExtension = strtolower(end($nameArray));
        $newImageName   = time().rand().'.'. $imageExtension;
        $imgContent     = addslashes(file_get_contents($imageTemp)); 
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
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {


            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {  

        $sql = "update blog set title = '$title' , content = '$content', date = '$date', image = '$imgContent' where  id = $id";

        $operation  =  mysqli_query($conn,$sql);


        if($operation ){

          $_SESSION['Message']  = 'Raw Updated'; 

          header("Location: index.php");
         


        }else{
            echo 'Error '.mysqli_error($con);
        }

        mysqli_close($conn);

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Blog</h2>
      
        <form action="update.php?id=<?php echo $id;?>" method="post">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" id="exampleInputTitle" aria-describedby=""   name="title" placeholder="Enter suitable Title">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" id="exampleInputContent" aria-describedby="" name="content" placeholder="Your content">
            </div>

            <div class="form-group">
                <label for="exampleInputDate">Date</label>
                <input type="date" class="form-control" id="exampleInputDate"   name="date" value="2022-02-14">
            </div>
            <div class="form-group">
                <label for="exampleInputImage">Image</label>
                <input type="file" class="form-control" id="exampleInputImage"   name="image" placeholder="Your Profile Image">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>