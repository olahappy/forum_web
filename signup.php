<?php
session_start();
  include ('config/constants.php');

$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$cpassword = $_SESSION['signup-data']['cpassword'] ?? null;

unset($_SESSION['signup-data']);
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
    <title>Sign up</title>
</head>
<body>

    <section class="form-sect">
        <div class="container form-cont">
            <h2>Sign up</h2>
            <?php 
            if(isset($_SESSION['signup'])) : ?>
                <div class="alert-message error">
                <p>
                    <?= $_SESSION['signup'] ; 
                    unset( $_SESSION['signup']);?>
                </p>
            </div>
             <?php endif ?>
            <form action="<?= ROOT_URL ?>signuplogic.php"  enctype="multipart/form-data" method="POST">
                <input type="text" name="username" id="" placeholder="Username" value="<?= $username ?>"> 
                <input type="email" name="email" id="" placeholder="Email" value="<?= $email ?>">
                <input type="password" name="password" id="" placeholder="Password" value="<?= $password ?>">
                <input type="password" name="cpassword" id="" placeholder="Confirm password" value="<?= $cpassword ?>">
                <div class="form-control">
                    <label for="avatar">
                        <input type="file" name="avatar" id="avatar">
                    </label>
                </div>
                <button type="submit" name="submit" class="btn">
                    Sign up
                </button>
                <small>Already have an account? <a href="./signin.php">Sign in</a></small>
            </form>
        </div>
    </section>    

</body>
</html>