<?php
session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');
if(isset($_SESSION['user_id'])) {
    $id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT) ;
$query = "SELECT file  FROM userpage where id = $id ";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0){
$avatar = mysqli_fetch_assoc($result);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/styles.css">
    <title>Communities</title>
</head>
<body>
    <nav>
        <div class="container navcont">
                <a href="<?= ROOT_URL ?>index.php" class="logo">Online Communities</a>
                <ul class="nav-items">
                    <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                    <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                    <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                    <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
               <?php if(isset($_SESSION['user_id'])) :  ?>     
                        <li class="profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/'. $avatar['file'] ?>" alt=""  >
                        </div>
                            <ul>
                                <li><a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a></li>
                                <li><a href="<?= ROOT_URL ?>logout.php">Log out</a></li>
                            </ul>
                    </li>
                   <?php else: ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
                    <?php endif ?>
                </ul>
                <button id="open"></button>
                <button id="close"></button>
        </div>
    </nav>



