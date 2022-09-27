<?php
session_start();
include ('config/constants.php');
$username = $_SESSION['signin-data']['username'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);


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
    <link rel="stylesheet" href="./css/styles.css">
    <title>Sign in</title>
</head>
<body>
    <section class="form-sect">
        <div class="container form-cont">
            <h2>Sign in</h2>
             <?php  
             if (isset($_SESSION['signup-success'])) : 
             ?>            
             <div class="alert-message success">
                <p><?=  $_SESSION['signup-success'];
                unset($_SESSION['signup-success']);
                 ?></p>
            </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
            <div class="alert-message error">
                <p><?= $_SESSION['signin'];
                unset($_SESSION['signin']);
                 ?></p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <input type="text" name="username" id="" placeholder="Username or Email" value="<?= $username ?>">                
                <input type="password" name="password" id="" placeholder="Password" value="<?= $password ?>">
                <button type="submit" name="submit" class="btn">
                    Sign in
                </button>
                <small>Don't have an account? <a href="./signup.php">Sign up</a></small>
            </form>
        </div>
    </section>    
</body>
</html>