<?php
    $db_host="localhost";
    $db_username="root";
    $db_password="";
    $db_name="webboard";

    $conn = @mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if(!$conn){
        //exit("Could not connect to database.");
        echo "Error: ".mysqli_connect_errno()." ".mysqli_connect_error();
        exit();
    }

    mysqli_set_charset($conn, "utf8");
?>
