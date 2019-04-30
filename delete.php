<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'a' || !isset($_GET['postNumber']) || $_GET['postNumber'] == ''){
        header('Location: index.php');
        die();
    }

    include 'connect.php';

    //Delete all comment in this post
    $sql = "DELETE FROM comment WHERE post_id = ".$_GET['postNumber'];
    $result = mysqli_query($conn, $sql);

    //Delete post
    $sql = "DELETE FROM post WHERE id = ".$_GET['postNumber'];
    $result = mysqli_query($conn, $sql);
     
    if($result){
        //success
        header('Location: index.php');
        die();
    }else{
        //error
        echo mysqli_error($conn);
    }
    

?>