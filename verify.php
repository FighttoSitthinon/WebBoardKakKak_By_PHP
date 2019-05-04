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
        include 'connect.php';

        $id = $_POST['id'];
        $pass = $_POST['password'];
        $msg = "";

        $sql = "SELECT password, role, gender FROM user WHERE login = '".$_POST['id']."' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resp = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($id =='admin' && $pass =='ad1234'){
            $msg = "ยินดีต้อนรับ ADMIN";
            $_SESSION["username"] = $id;
            $_SESSION["gender"] = $resp['gender'];
            $_SESSION["role"] = "a";
            $_SESSION["id"] = session_id();
            unset($_SESSION['error']);
            header('Location: index.php');
            die();
        }elseif($id =='member' && $pass =='mem1234'){
            $msg = "ยินดีต้อนรับ MEMBER";
            $_SESSION["username"] = $id;
            $_SESSION["gender"] = $resp['gender'];
            $_SESSION["role"] = "m";
            $_SESSION["id"] = session_id();
            unset($_SESSION['error']);
            header('Location: index.php');
            die();
        }elseif(isset($resp['password']) && isset($resp['role']) && $resp['password'] == $pass){
            $msg = "ยินดีต้อนรับ".$id;
            $_SESSION["username"] = $id;
            $_SESSION["gender"] = $resp['gender'];
            $_SESSION["role"] = $resp['role'];
            $_SESSION["id"] = session_id();
            unset($_SESSION['error']);
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
