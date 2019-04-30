<?php

function newpost($title, $content, $category ){
    include 'connect.php';
    $event = null;

    if(isset($_SESSION["username"])){
        //Get ID from login user
        $sql = "SELECT id FROM user WHERE login = '".$_SESSION['username']."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resp = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($category != '' && $title!= '' && $content != '' && isset($resp['id']))
        { 
            $value = "('{$title}', '{$content}', NOW(), '{$category}', '{$resp['id']}')";
            $sql = "INSERT INTO post (title, content, post_date, cat_id, user_id) VALUES ";
            $sql = $sql.$value;
            //echo $sql;

            $result = mysqli_query($conn, $sql);
            if($result){
                $event = 0; // Success
            }else{
                echo mysqli_error($conn);
                $event = 1; // Error
            }
        }else{
            $event = 2; // Error
        }
    }else{
        $event = 3; // Error
    }
    return $event;
}
?>