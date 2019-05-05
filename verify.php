<?php
     //session_start();
    if(isset($_SESSION['id']) && $_SESSION['id']==session_id()){
        header('Location: index.php');
        die();
    }
    
    function verify($id, $pass){
        include 'connect.php';

        $event = null;
        //check exist account
        $sql = "SELECT password, role, gender FROM user WHERE login = '".$_POST['id']."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resp = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if(isset($resp['password']) && isset($resp['role']) && $resp['password'] == $pass){
            $_SESSION["username"] = $id;
            $_SESSION["gender"] = $resp['gender'];
            $_SESSION["role"] = $resp['role'];
            $_SESSION["id"] = session_id();
            //unset($_SESSION['error']);
            header('Location: index.php');
            die();
        }else{
            //$_SESSION['error'] = "บัญชีหรือรหัสผ่านไม่ถูกต้อง";
            $event = 'l_e01';
            //header('Location: login.php');
            //die();
        }
        return $event;
    }
