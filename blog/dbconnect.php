<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "blogDB";
    
    $conn =   mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);
    if (!$conn) {
        die('Error: ' . mysql_connect_error());
    }
    // else {
    //     echo "connected";
    // }
?> 