<?php
   require './blog.php';

   $blog = new blog;
   $data =  $blog->showData();

   if ($_SERVER['REQUEST_METHOD'] == "POST") {

     $result = $blog->register($_POST);

     foreach($result as $key => $value){
         echo '* '.$key.' : '.$value.'<br>';
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
                <input type="text" class="form-control" id="exampleInputTitle" aria-describedby=""   name="title" placeholder="" value="<?php  echo $value['title'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" id="exampleInputContent" aria-describedby="" name="content" placeholder="" value="<?php  echo $value['content'];?>">
            </div>

            <div class="form-group">
                <label for="exampleInputImage">Image</label>
                <input type="file" class="form-control" id="exampleInputImage"   name="image" placeholder="" value="<?php  echo $value['image'];?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>