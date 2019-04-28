<?php
    session_start();
    if(isset($_SESSION['id']) && $_SESSION['id']==session_id()){
        header('Location: index.php');
        die();
    }elseif(!isset($_POST['id']) && !isset($_POST['password'])){
        header('Location: login.php');
        die();
    }

    function verify(){
        $id = $_POST['id'];
        $pass = $_POST['password'];
        $msg = "";
        if($id =='admin' && $pass =='ad1234'){
            $msg = "ยินดีต้อนรับ ADMIN";
            $_SESSION["username"] = $id;
            $_SESSION["role"] = "a";
            $_SESSION["id"] = session_id();
            session_unset($_SESSION['error']);
            header('Location: index.php');
            die();
        }elseif($id =='member' && $pass =='mem1234'){
            $msg = "ยินดีต้อนรับ MEMBER";
            $_SESSION["username"] = $id;
            $_SESSION["role"] = "m";
            $_SESSION["id"] = session_id();
            session_unset($_SESSION['error']);
            header('Location: index.php');
            die();
        }else{
            $_SESSION['error'] = "บัญชีหรือรหัสผ่านไม่ถูกต้อง";
            header('Location: login.php');
            die();
        }
    }
    verify();

    ?>
