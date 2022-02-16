
<?php
require 'dbconnect.php';
require 'sanitize.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Sanitize($_POST['title']);
    $content   = Sanitize($_POST['content']);
    $sDate     = $_POST['sDate'];
    $eDate     = $_POST['eDate'];
    // var_dump(checkdate($sDate));
    // var_dump(checkdate($eDate));
    // Validate 

    $errors = [];
    if (empty($title)) {
        $errors['Title'] = "Field Required";
    }
    if (empty($content)) {
        $errors['Content'] = "Field Required";
    }
    
    if (empty($sDate)) {
        $errors['sDate'] = "Specify a start date";
    }
    if (empty($eDate)) {
        $errors['eDate'] = "Specify an end date";
    }
    if (empty($_FILES['image']['name'])) {
       
         $errors['Image']   = "Field Required";
    
    }else{

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];   

        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));
        $imgFinalName = time() . rand() . '.' . $imgExtension;
        $allowedExt = ['png', 'jpg', 'jpeg'];

        if (!in_array($imgExtension, $allowedExt)) {
            $errors['Image']   = "Not Allowed Extension";
        }

    }

    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } 
    else {
        $disPath = 'images/' . $imgFinalName;

        if (move_uploaded_file($imgTemp, $disPath)) {

        $sql = "insert into tasks (title,content,sDate,eDate,image) values ('$title','$content','$sDate','$eDate','$imgFinalName')";

        $op  =  mysqli_query($con,$sql);

        mysqli_close($con);

        if($op){
            echo 'Item Added';
        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }
    }else{
        echo 'Errot Try Again ... ';
    }

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>To Do List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>To Do List</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title" placeholder="Title...">
            </div>



            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" required id="exampleInputContent" aria-describedby="" name="content" placeholder="Content...">
            </div>

            <div class="form-group">
                <label for="exampleInputContent">Start Date</label>
                <input type="date" class="form-control" required id="exampleInputContent" aria-describedby="" name="sDate" placeholder="">
            </div>

            <div class="form-group">
                <label for="exampleInputEDate">End Date</label>
                <input type="date" class="form-control" required id="exampleInputEDate" aria-describedby="" name="eDate" placeholder="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Add New Item </button>
        </form>
    </div>


</body>

</html>