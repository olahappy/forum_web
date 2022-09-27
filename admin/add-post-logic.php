<?php

session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user_id'] ;
    $title = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'] ;

    $is_featured = $is_featured == 1 ? : 0;

    if(!$title){
        $_SESSION['add-post'] = "Enter post title" ;
    }
    elseif(!$body){
        $_SESSION['add-post'] = "Enter post body" ;
    }
    elseif(!$category_id){
        $_SESSION['add-post'] = "Enter post category" ;
    }
    elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "Choose post thumbnail" ;
    }
    else{
        $time = time();
        $thumbnail_name = $time. $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $destination_path = '../images/'. $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];

        $extension = explode('.', $thumbnail_name);

        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            if($thumbnail['size'] < 1000000){
                move_uploaded_file($thumbnail_tmp_name, $destination_path);
             }
             else{
                $_SESSION['add-post'] = 'File size too big , should be less than 1mb';
             }
        }
        else{
            $_SESSION['add-post'] = 'File should be png, jpg or jpeg';
    }
    }
      
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST ;
        header('location: ' . ROOT_URL. 'admin/add_posts.php' ) ;
        die() ;
    }
    else{
        if($is_featured == 1){
            $confused = "UPDATE topics SET is_featured = 0" ;
            $confused_result = mysqli_query($connect, $confused) ;
        }

        $query = "INSERT INTO topics  (topic_title, text, thumbnail, is_featured, category_id , author_id) VALUES ('$title', '$body','$thumbnail_name', '$is_featured', '$category_id', '$author_id')";
        $result = mysqli_query($connect, $query);

        if(!mysqli_errno($connect)){
            $_SESSION['add-post-success'] = 'Posts added sucessfully';
            header('location: '. ROOT_URL. 'admin/dashboard.php');
            die();
        }
    }
}

header('location : '. ROOT_URL . 'admin/add_posts.php')
?>