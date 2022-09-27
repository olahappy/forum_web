<?php
session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_POST['submit'])){
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(empty($description)){
        $_SESSION['add-comment'] = "Enter Description";
    }

    if(isset($_SESSION['add-comment'])){
        $_SESSION['add-comment-data'] = $_POST;
        header('location: '. ROOT_URL. 'admin/add_cat.php');
        die();
    }
    else{
        $query = "INSERT INTO comment( body ) VALUES('$description')" ;
        $result = mysqli_query($connect, $query);
        if(mysqli_errno($connect)){
            $_SESSION['add-comment'] = 'Could not add Category';
            header('location:  '. ROOT_URL. 'admin/add-comment.php'); 
            die();
           }         
           else{
             $_SESSION['add-comment-success'] = "Comment $title added sucessfully" ;
             header('location:  '. ROOT_URL ); 
            die();
           }
    }
}