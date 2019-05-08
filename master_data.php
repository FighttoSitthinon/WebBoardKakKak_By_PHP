<?php
session_start();
include 'connect.php';
include 'action_msg.php';
include 'master_data_save.php';

if (!isset($_SESSION['id']) && $_SESSION['id'] != session_id()) {
    header('Location: login.php');
    die();
}
if($_SESSION["role"] != 'a'){
    header('Location: index.php');
    die();
}

$event = null;

$sqlCat = "SELECT * FROM category";
$resultCat = mysqli_query($conn, $sqlCat);

if (isset($_POST['cat_name'])) {
    $event = addNewCat($_POST['cat_name']);
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
    <title>Master data</title>
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
                if ($event == 'c_s00') {
                    //success
                    echo "<div class='alert alert-success alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>สำเร็จ!</strong> " . $msg[$event] . "</div>";
                } else {
                    //error
                    echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>เกิดข้อผิดพลาด!</strong> " . $msg[$event] . "</div>";
                }
            }
            ?>
            <div>
                <h2>Category Admin permission</h2>
                <hr>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col" style='text-align:center'>ID</th>
                            <th scope="col" colspan="2">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($resultCat, MYSQLI_ASSOC)) {
                            echo "<tr>
                                        <th scope='row'  style='text-align:center'>" . $row['id'] . "</th>
                                        <td colspan='2'>" . $row['name'] . "</td>
                                    </tr>";
                        }
                        ?>
                        <tr>
                            <form action="master_data.php" method="post">
                                <th scope="row" style="text-align:center">New</th>
                                <td>
                                    <input class="form-control" type="text" name="cat_name">
                                </td>
                                <td>
                                    <input class="btn btn-success" type="submit" value="Add new data">
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
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