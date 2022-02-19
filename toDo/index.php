<?php
require 'dbconnect.php';
require 'checklogin.php';
$user_id = intval($_GET['id']);
$sql  = "SELECT * FROM tasks WHERE tasks.user_id = $user_id";

$data = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Display Page</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Display Tasks</h1>
                <br>
                <?php
                echo 'Welcome, ' . $_SESSION['user']['name'] . '<br>';
                if(isset($_SESSION['Mesage'])) {
                    echo $_SESSION['Message'];
                    unset($_SESSION['Message']);
                }
                ?>
            </div>
            <a href="create.php">Add new Task</a> || <a href="logout.php">LogOut</a>
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Image</th>
                    <th>usr_id</th>
                    <th>Action</th>       
                </tr>
                <?php
                while($result = mysqli_fetch_assoc($data)) {
                ?>    
                    <tr>
                        <td><?php echo $result['id'];?></td>
                        <td><?php echo $result['title'];?></td>
                        <td><?php echo $result['content'];?></td>
                        <td><?php echo $result['sDate'];?></td>
                        <td><?php echo $result['eDate'];?></td>
                        <td><?php echo $result['user_id'];?></td>
                        <td><img src="./uploads/<?php echo $result['image'];?>" alt="" height="50" width="50"></td>
                        <td>
                           <a href='delete.php?id=<?php  echo $result['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                       </td>
                    </tr>
                <?php } ?>
                
            </table>
        </div>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysqli_close($con);
?>`