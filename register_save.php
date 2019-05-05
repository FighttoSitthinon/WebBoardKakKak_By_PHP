<?php

function register($login, $password1, $password2, $name, $gender, $email){
    include 'connect.php';
    $event = null;
    if($password1 == $password2){
        $password = $password1;
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
                    $event = 'r_s00'; // สมัครผู้ใช้งานใหม่เสร็จสิ้น
                }else{
                    echo mysqli_error($conn);
                    $event = 'r_e01'; // Error
                }
            }else{
                $event = 'r_e02'; // ชื่อผู้ใช้ซ้ำ
            }
        }else{
            $event = 'r_e03'; //กรอกไม่ครบ
        }
    }else{
        $event = 'r_e04';
    }
    
    return $event;
}

?>
