<?php
session_start();

include 'register_save.php';

if (isset($_SESSION['id']) && $_SESSION['id'] == session_id()) {
    header('Location: index.php');
    die();
}

$event = null;
$msg = [
    0 => "สมัครผู้ใช้งานใหม่เสร็จสิ้น",
    1 => "เกิดข้อผิดพลาดในการสมัคร",
    2 => "ชื่อผู้ใช้นี้มีผู้ใช้งานแล้ว",
    3 => "โปรดกรอกข้อมูลให้ครบถ้วน"
];

if (isset($_POST['name']) && isset($_POST['username'])  && isset($_POST['password'])  && isset($_POST['email'])) {
    $event = register($_POST['username'], $_POST['password'], $_POST['name'], $_POST['gender'], $_POST['email']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Register</title>
</head>


<body>
    <br>
    <h1>Webboard Kakkak</h1>
    <hr>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <h2><a class="navbar-brand" href="index.php">Kakkak</a></h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNavDropdown" class="navbar-collapse collapse">
                <ul class="navbar-nav mr-auto">
                    <div class="nav-item active">
                        <a class="nav-link" href="index.php"><i class='fas fa-home'></i> Home <span class="sr-only">(current)</span></a>
                    </div>
                </ul>
                <div class="nav-item">
                    <?php
                    if (!isset($_SESSION["id"])) {
                        echo "<a class='nav-link' href='login.php'><i class='fas fa-edit' ></i> เข้าสู่ระบบ</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <hr>
        <?php
        if (isset($event)) {
            if ($event == 0) {
                echo "<div class='alert alert-success alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>สำเร็จ!</strong> " . $msg[$event] . "</div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>เกิดข้อผิดพลาด!</strong> " . $msg[$event] . "</div>";
            }
        }
        ?>
        <div class="card border-primary" style="margin-left:20%;margin-right:20%;">
            <div class="card-body">
                <h4 class="card-header" style="text-align:center"> สมัครสมาชิก</h4>
                <div class="center">
                    <form action="register.php" method="post">
                        <div class="row">
                            <div class="col-md-4">ID</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Password</div>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Name</div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Sex</div>
                            <div class="col-md-8">
                                <label class="radio-inline"><input type="radio" name="gender" value="m" checked> Male</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="f"> Female</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="o"> Other</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="row" style="text-align: center; padding-left:15px; padding-right:15px;">
                            <input type="submit" class="btn btn-primary btn-block" value="Register">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="center" style="text-align: center;">
            <br>
            <p><a href="index.php" class="btn btn-outline-secondary ">กลับหน้าหลัก</a></p>
        </div>
    </div>
</body>

</html>