<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'a' || !isset($_GET['postNumber']) || $_GET['postNumber'] == ''){
        header('Location: index.php');
        die();
    }

    include 'connect.php';

    $sql = "DELETE FROM post WHERE id = ".$_GET['postNumber'];
    $result = mysqli_query($conn, $sql);
     
    if($result){
        //success
        header('Location: index.php');
        die();
    }else{
        //error
        mysqli_error($conn);
    }
    

?>