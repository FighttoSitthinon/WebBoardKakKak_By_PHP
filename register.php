<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] == session_id()) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Register</title>
</head>
<style>
    #login {
        float: right;
    }

    h1 {
        text-align: center;
    }

    div.row {
        padding-top: 15px;
    }
</style>

<body>
    <br>
    <h1>Register</h1>
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
            </div>
        </nav>
        <hr>

        <div class="card border-primary" style="margin-left:20%;margin-right:20%;">
            <div class="card-body">
                <h4 class="card-header" style="text-align:center"> สมัครสมาชิก</h4>
                <div class="center">
                    <div class="row">
                        <div class="col-md-4">ID</div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Password</div>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Name</div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Sex</div>
                        <div class="col-md-8">
                            <label class="radio-inline"><input type="radio" name="optradio" checked> Male</label>
                            <label class="radio-inline"><input type="radio" name="optradio"> Female</label>
                            <label class="radio-inline"><input type="radio" name="optradio"> Other</label>
                        </div>
                    </div>
                    <div class="row" style="text-align: center; padding-left:15px; padding-right:15px;">
                        <input type="submit" class="btn btn-primary btn-block" value="Register">
                    </div>
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