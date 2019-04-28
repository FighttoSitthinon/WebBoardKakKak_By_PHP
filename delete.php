<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'a'){
        header('Location: index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>New Post</title>
</head>
<style>
    #login {
        float: right;
    }

    h1 {
        text-align: center;
    }

    div.row {
        font-size: 17px;
        padding-top: 15px;
    }
</style>

<body>
    <h1>Delete</h1>
    <hr>
    <div class="container">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="row" style="text-align: center;">
                <?php
                    $postNumber = $_GET['postNumber'];
                    echo '<b>ลบกระทู้หมายเลข '.$postNumber.' เรียบร้อยแล้ว</b>';
                
                ?>
                <br>
                <br>
                <p><a href="index.php">กลับหน้าหลัก</a></p>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

</body>

</html>