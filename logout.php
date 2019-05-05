<?php
    session_start();

    if(isset($_SESSION['id']) && $_SESSION['id']==session_id()){
       // echo "case 01";
        session_unset();
        session_destroy();
        header("refresh: 0.5; url=index.php");
    }else{
        //echo "case 02";
        header('Location: login.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Log out</title>
</head>


<body>
    <h1>Log Out.....</h1>
    <hr>
    <div class="container">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="row" style="text-align: center;">
                <h3>ออกจากระบบเสร็จสิ้น</h3> <br>
                <p>หากไม่มีการเปลี่ยนหน้า กรุณากดปุ่ม </p>
            </div>
            <div class="row" style="text-align: center;">
                <p><a href="index.php">กลับหน้าหลัก</a></p>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

</body>

</html>