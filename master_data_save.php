<?php

function addNewCat($cat_name){
    include 'connect.php';
    $event = null;

    if ($cat_name != '')
    { 
        $sql = "INSERT INTO category (name) VALUES ('{$cat_name}')";
        echo $sql;

        $result = mysqli_query($conn, $sql);

        if($result){
            $event = 'c_s00'; // Success
            header("refresh: 0;");
        }else{
            echo mysqli_error($conn);
            $event = 'c_e01'; // Error
        }    
    }
    return $event;
}
?>