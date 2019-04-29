<?php
session_start();
include 'connect.php';

$sqlCat = "SELECT * FROM category";
$resultCat = mysqli_query($conn, $sqlCat);

$sqlPost = "SELECT post.id, post.title, post.post_date, category.name AS cat_name, user.name AS user_name FROM post 
            JOIN category ON post.cat_id = category.id 
            JOIN user ON post.user_id = user.id
            ORDER BY post.post_date DESC";
$resultPost = mysqli_query($conn, $sqlPost);

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
    <title>Index</title>
</head>
<style>

</style>

<body>

    <div class="container">
        <hr>
        <h1>Hello KakKak</h1>
        <hr>
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h2><a class="navbar-brand" href="#">Kakkak</a></h2>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNavDropdown" class="navbar-collapse collapse">
                    <ul class="navbar-nav mr-auto">
                        <div class="nav-item active">
                            <a class="nav-link" href="#"><i class='fas fa-home'></i> Home <span class="sr-only">(current)</span></a>
                        </div>
                    </ul>
                    <ul class="navbar-nav">
                        <div class="nav-item dropdown">

                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<a class='nav-link dropdown-toggle' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>user: " . $_SESSION['username'];
                            }
                            ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                if (isset($_SESSION["id"])) {
                                    echo "<a class='nav-link' href='logout.php'>  <i class='fas fa-power-off' ></i>  ออกจากระบบ</a>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="nav-item">
                            <?php
                            if (!isset($_SESSION["id"])) {
                                echo "<a class='nav-link' href='login.php'><i class='fas fa-edit' ></i> เข้าสู่ระบบ</a> ";
                            }
                            ?>

                        </div>
                        <div class="nav-item">
                            <?php
                            if (!isset($_SESSION["id"])) {
                                echo "<a class='nav-link' href='register.php'> สมัครสมาชิก</a>";
                            }
                            ?>

                        </div>
                    </ul>
                </div>
            </nav>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-2">หมวดหมู่: </div>
                <div class="col-4">
                    <select name="group" id="" class="form-control">
                        <option value="">--ทั้งหมด--</option>
                        <?php
                        while ($row = mysqli_fetch_array($resultCat, MYSQLI_ASSOC)) {
                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6" style="text-align:right;">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "<p><button class='btn btn-success'><i class='fas fa-plus'></i><a style='color:white' href='newpost.php'>  สร้างกระทู้ใหม่</a></button></p>";
                    }

                    ?>
                </div>
            </div>
            <br>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'a') {
                            while ($row = mysqli_fetch_array($resultPost, MYSQLI_ASSOC)) {
                                echo "<tr><td>[ " . $row['cat_name']. " ]&nbsp&nbsp <a href='post.php?postNumber={$row['id']}'> " . $row['title'] . "</a><br> " . $row['user_name'] . " - " . $row['post_date'] . "</td> <td><a  href='delete.php?postNumber={$row['id']}'><i class='fas fa-trash-alt' style='color:red'></i> </a></td></tr>";
                            }
                        } else {
                            while ($row = mysqli_fetch_array($resultPost, MYSQLI_ASSOC)) {
                                echo "<tr><td>[ " . $row['cat_name']. " ]&nbsp&nbsp <a href='post.php?postNumber={$row['id']}'> " . $row['title'] . "</a><br> " . $row['user_name'] . " - " . $row['post_date'] . "</td> </tr>";
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
            <!--
    <div class="row">
        <ul class="list-group">
            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'a') {
                for ($i = 1; $i <= 5; $i++)
                    echo "<li class='list-group list-group-horizontal'><a class='list-group-item' href='../work/post.php?postNumber={$i}'>กระทู้ที่ " . $i . "</a> <a class='list-group-item' href='delete.php?postNumber={$i}'><i class='fas fa-trash-alt' style='color:red'></i> </a></li>";
            } else {
                for ($i = 1; $i <= 5; $i++)
                    echo "<a class='list-group-item list-group-item-action' href='../work/post.php?postNumber={$i}'>กระทู้ที่ " . $i . "</a>";
            }
            ?>
        </ul>
    </div>-->
        </div>
    </div>
</body>

</html>