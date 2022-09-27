<?php
session_start();

include ('config/database.php');
if (isset($_POST['username'])){
    $username = $_POST['username'];
    $password =$_POST['password'];

    $sql = "SELECT * FROM userpage WHERE username='$username'  AND password='$password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

            $_SESSION['username'] = $row['username'];

               $user_id =  $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['forum_noify'] = $row['forum_notify'];
              if($row['forum_notify'] == 1){
                $_SESSION['user_is_admin'] = true;
                header('Location: admin/dashboard.php');
              } 
              elseif($row['forum_notify'] == 0){
                header("Location: index.php");   
              }
            exit();
        }else{
          $_SESSION['signin'] = "user not found!";
        }        
        if(isset($_SESSION['signin'])){
                  $_SESSION['signin-data'] = $_POST;
                  header('location:  signin.php'); 
                  die();
              }
    }else{
      header('location:  signin.php'); 
        // header("Location: login.php?error=Incorect User name or password");
        exit();

    }
?>
// <?php
// if(isset($_POST['submit'])){
//     $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     if(!$username){
//         $_SESSION['signin'] = "Please enter your username or email!";
//     }
//     elseif(!$password){
//         $_SESSION['signin'] = "Password required!";
//     } 
//     else{
//         $fetch_user = "SELECT * FROM userpage WHERE username = '$username' OR email = '$username' ";
//         $fetch_user_result = mysqli_query($connect, $fetch_user);

//         if(mysqli_num_rows($fetch_user_result) == 1){
// // convert into associative array
// $user_record = mysqli_fetch_assoc($fetch_user_result);
// $db_password = $user_record['password'];
// if(password_verify($password, $db_password)){
//     $_SESSION['user-id'] = $user_record['id'];
//     if($user_record['forum_notify'] == 1){
//         $_SESSION['user_is_admin'] = true;
//     }

//     header('location: admin/');
// }
// else{
//     $_SESSION['signin'] = "Please check your input!";
// }
//  }
//         else{
//             $_SESSION['signin'] = "user not found!";
//         }
//     }

//     if(isset($_SESSION['signin'])){
//         $_SESSION['signin-data'] = $_POST;
//         header('location:  signin.php'); 
//         die();
//     }
// }
// else{
//     header('location:  signin.php'); 
//     die();
// }
// ?>