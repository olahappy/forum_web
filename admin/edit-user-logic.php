<?php
session_start();
define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');


if(isset($_POST['submit'])){
    // get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['select'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid inpu
    if(!$username){
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    }
    else{
        // update user
        $query = "UPDATE userpage SET username = '$username', forum_notify = $is_admin  WHERE id = $id LIMIT 1";
        $result = mysqli_query($connect, $query);

        if(mysqli_errno($connect)){
            $_SESSION['edit-user'] = "Failed to update user";
        }
        else{
            $_SESSION['edit-user-success'] = "User $username Updated successfully";
        }
    }
}
header('location: '. ROOT_URL. 'admin/manage_users.php');
die();


?>