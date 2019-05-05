<?php
include 'action_msg.php';

if ( isset($_POST['comment']) && isset($_POST['postNumber'])) {
    //echo $_GET['comment'];
    $event = comment($_POST['comment'], $_POST['postNumber']);
    //echo $msg[$event];
}

function comment($comment, $post_id){

    session_start();
    include 'connect.php';

    $event = null;
    
    if(isset($_SESSION["username"])){
        //Get ID from login user
        $sql = "SELECT id FROM user WHERE login = '".$_SESSION['username']."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resp = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($comment != '' && $post_id != '' && isset($resp['id']))
        { 
            $value = "('{$comment}', NOW(), '{$resp['id']}', '{$post_id}')";
            $sql = "INSERT INTO comment (content, post_date, user_id, post_id) VALUES ";
            $sql = $sql.$value;

            $result = mysqli_query($conn, $sql);

            if($result){
                $event = 'c_s00'; // Success
                header('Location: post.php?postNumber='.$_POST['postNumber']);
                die();
            }else{
                echo mysqli_error($conn);
                $event = 'c_e01'; // Error
            }
        }else{
            $event = 'c_e02'; // Error
        }
    }else{
        $event = 'c_e03'; // Error
    }
    return $event;
}
?>