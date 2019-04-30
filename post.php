<?php
session_start();
include 'comment_save.php';
include 'connect.php';


if (!isset($_GET['postNumber']) || $_GET['postNumber'] == '') {
    header('Location: index.php');
    die();
}

$postNumber = $_GET['postNumber'];

$sql =  "SELECT post.id, post.title, post.content, post.post_date, category.name AS cat_name, user.name AS user_name FROM post 
            JOIN category ON post.cat_id = category.id 
            JOIN user ON post.user_id = user.id
            WHERE post.id = " . $postNumber;
$result = mysqli_query($conn, $sql);
$resp = mysqli_fetch_array($result, MYSQLI_ASSOC);

$sqlComment =  "SELECT comment.content, comment.post_date, user.name AS user_name FROM comment 
                JOIN user ON user.id = comment.user_id
                WHERE comment.post_id = '" . $postNumber . "'
                ORDER BY post_date;";
$resultComment = mysqli_query($conn, $sqlComment);


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
    <title>Post</title>
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
                            echo "<a class='nav-link' href='login.php'><i class='fas fa-edit' ></i> เข้าสู่ระบบ</a>";
                        }
                        ?>

                    </div>
                </ul>
            </div>
        </nav>
        <hr>
        <div class="center">
            <div class="container">
                <div style="padding-left:10%;padding-right:10%;">
                    <h2>
                        <?php echo "[ " . $resp['cat_name'] . " ] " . $resp['title']; ?>
                    </h2>
                    <p>
                        <b>กระทู้หมายเลข <?php echo '' . $_GET['postNumber'] ?></b>
                    </p>
                    <hr>
                    <div>
                        <div class="jumbotron">
                            <?php echo $resp['content']; ?>
                        </div>
                    </div>
                    <div style="font-size: 15px; margin-bottom: 30px; padding-left:10px;">
                        <i>
                            <?php echo "Create by " . $resp['user_name'] . " - " . $resp['post_date']; ?>
                        </i>
                    </div>
                    <hr>
                </div>
            </div>
            <br>
            <h3 style="margin-left:15%;"><i>ความคิดเห็น</i></h3>
            <br>
            <div style="margin-left:15%;margin-right:15%;">

                <?php
                if (($row = mysqli_fetch_array($resultComment, MYSQLI_ASSOC)) == null) { 
                    echo    "<i>ยังไม่มีการแสดงความคิดเห็น</i>";    

                } else {
                    while ($row = mysqli_fetch_array($resultComment, MYSQLI_ASSOC)) {
                        ?>

                        <div class="card" style="padding-bottom:10px;">
                            <div class="row">
                                <div class="col-3" style="text-align:center;">
                                    <img style="margin:5px;" width="100" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                </div>
                                <div class="col-9">
                                    <div class="card-body">
                                        <strong class="card-title"><?php echo $row['user_name'] ?> </strong>
                                        <p class="card-text"><?php echo $row['content']; ?></p>
                                        <i style="font-size: 15px"><?php echo "ความคิดเห็นเมื่อ : " . $row['post_date'] ?></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                    <?php
                }
            }


            ?>
            </div>
            <br>
            <hr>

            <div class="card border-success" style="margin-left:20%;margin-right:20%;">
                <div class="card-body">
                    <h4 class="card-header" style="text-align:center"> แสดงความคิดเห็น</h4>
                    <div class="center">
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <?php
                            if (isset($_SESSION['id']) && $_SESSION['id'] == session_id()) {
                                ?>
                                <form action="comment_save.php" method="post">
                                    <input type="hidden" name="postNumber" value="<?php echo $postNumber; ?>">
                                    <textarea class="form-control" rows="5" name="comment" placeholder="Comment right here..."></textarea>
                                    <div class="row" style="text-align: center; padding-left:15px; padding-right:15px;">
                                        <button type="submit" class="btn btn-outline-success btn-block">
                                            <i class="fas fa-paper-plane"></i> Send a message
                                        </button>
                                    </div>
                                </form>
                            <?php
                        } else {
                            ?>
                                <textarea readonly class="form-control" rows="5" placeholder="Comment right here..."></textarea>
                                <div class="row" style="text-align: center; padding-left:15px; padding-right:15px;">
                                    <button disabled type="submit" class="btn btn-outline-success btn-block">
                                        <i class="fas fa-paper-plane"></i> Send a message
                                    </button>
                                </div>
                                <br>
                                <p style="text-align: center;">กรุณา <a href="login.php">เข้าสู่ระบบ</a> เพื่อทำการแสดงความคิดเห็น</p>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="center" style="text-align: center;">
            <br>
            <p><a href="index.php" class="btn btn-outline-secondary ">กลับหน้าหลัก</a></p>
        </div>
</body>

</html>