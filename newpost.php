<?php
session_start();
include 'newpost_save.php';
include 'connect.php';
include 'action_msg.php';

if (!isset($_SESSION['id']) && $_SESSION['id'] != session_id()) {
    header('Location: login.php');
    die();
}

$event = null;

$sqlCat = "SELECT * FROM category";
$resultCat = mysqli_query($conn, $sqlCat);

if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category'])) {
    $event = newpost($_POST['title'], $_POST['content'], $_POST['category']);
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
    <title>New Post</title>
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
                <ul class="navbar-nav">
                    <div class="nav-item dropdown">

                        <?php
                        if (isset($_SESSION['username']) && isset($_SESSION['gender'])) {
                            if ($_SESSION['gender'] == 'm') {
                                echo "<a class='nav-link dropdown-toggle' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img style='margin:5px;' width='30' src='asset/boy.svg'> user: " . $_SESSION['username'] . "</a>";
                            } elseif ($_SESSION['gender'] == 'f') {
                                echo "<a class='nav-link dropdown-toggle' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img style='margin:5px;' width='30' src='asset/girl.svg'> user: " . $_SESSION['username'] . "</a>";
                            } else {
                                echo "<a class='nav-link dropdown-toggle' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img style='margin:5px;' width='30' src='https://ssl.gstatic.com/accounts/ui/avatar_2x.png'> user: " . $_SESSION['username'] . "</a>";
                            }
                        }
                        ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            if (isset($_SESSION["id"])) {
                                echo "<a class='nav-link' href='logout.php' style='text-align:center;'>  <i class='fas fa-power-off' ></i>  ออกจากระบบ</a>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="nav-item">
                        <?php
                        if (!isset($_SESSION["id"])) {
                            echo "<a class='nav-link' href='login.php'><i class='fas fa-edit' ></i> เข้าสู่ระบบ</a>";
                        }
                        ?>
                    </div>
                </ul>
            </div>
        </nav>
        <hr>
        <div class="center">
            <?php
            if (isset($event)) {
                if ($event == 'p_s00') {
                    //success
                    header('Location: index.php');
                    die();
                } else {
                    //error
                    echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>เกิดข้อผิดพลาด!</strong> " . $msg[$event] . "</div>";
                }
            }
            ?>
            <div class="card border-info" style="margin-left:15%;margin-right:15%;">
                <div class="card-body">
                    <h2 class="card-header" style="text-align:center"> ตั้งกระทู้ใหม่</h2>
                    <form action="newpost.php" method="post">
                        <div class="center">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="">หมวดหมู่: </label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">--ทั้งหมด--</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($resultCat, MYSQLI_ASSOC)) {
                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <form class="form-group">
                                <label for="topic">หัวข้อ</label>
                                <input class="form-control" type="text" name="title" id="title" placeholder="หัวข้อ....">
                                <br>
                                <label for="content">เนื้อหา:</label>
                                <textarea class="form-control" rows="5" id="content" name="content" placeholder="เนื้อหา.."></textarea>
                                <div class="row" style="text-align: center; padding-left:15px; padding-right:15px;">
                                    <button type="submit" class="btn btn-outline-info btn-block">
                                        <i class="fas fa-paper-plane"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
            <div class="center" style="text-align: center;">
                <br>
                <p><a href="index.php" class="btn btn-outline-secondary ">กลับหน้าหลัก</a></p>
            </div>
        </div>
    </div>

</body>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Create by Sitthinon Chanaritthichai : 
    <a target="_blank" href="https://github.com/FighttoSitthinon/WebBoardKakKak_By_PHP">@Github</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</html>