<?php

function register($login, $password, $name, $gender, $email){
    include 'connect.php';
    $event = null;
    if ($login != '' && $password!= '' && $name != '' && $gender != '' && $email!= '') 
    { 
        $queryUsername = "select login from user where login = '".$login."'";
        //echo "<br/>".$queryUsername;
        $resp = mysqli_query($conn, $queryUsername);
        $checkUsername = mysqli_num_rows($resp);
        //echo $checkUsername;
    
        // check user name not duplicate in db
    
        if($checkUsername == 0){
            $value = "('{$login}', '{$password}', '{$name}', '{$gender}', '{$email}', 'm')";
            //echo  $value;
        
            $sql = "insert into user (login, password, name, gender, email, role) values ";
            $sql = $sql.$value;
            //echo "<br/>".$sql;
        
            $result = mysqli_query($conn, $sql);
        
            if($result){
                //echo "เพิ่มผู้ใช้ใหม่เรียบร้อย";

                //header("refresh: 2; url=index.php");
                //exit(0);
                $event = 0; // สมัครผู้ใช้งานใหม่เสร็จสิ้น
            }else{
                mysqli_error($conn);
                $event = 1; // Error
            }
        }else{
            $event = 2; // ชื่อผู้ใช้ซ้ำ
        }
    }else{
        $event = 3; //กรอกไม่ครบ
    }
    return $event;
}

?>
