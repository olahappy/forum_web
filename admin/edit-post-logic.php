<?php

session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_POST['submit'])){
    $prev_thumbnail = filter_var($_POST['previousthumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['check'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['file'] ;

    $is_featured = $is_featured == 1 ? : 0;

    if(!$title){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data " ;
    }
    elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data" ;
    }
    elseif(!$category_id){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data" ;
    }
    else{
        // delete existing thumbnail if new one available
        if($thumbnail['name']){
            $prev_thumbnail_path = '../images/' . $prev_thumbnail_name;
            if($prev_thumbnail_path){
                unlink($prev_thumbnail_path);
            }

// work on new thumbnail
// rename image
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
                $_SESSION['edit-post'] = 'File size too big , should be less than 1mb';
             }
        }
        else{
            $_SESSION['edit-post'] = 'File should be png, jpg or jpeg';
    }
        }
    }

    if(isset($_SESSION['edit-post'])){
        header('location: ' . ROOT_URL. 'admin/' ) ;
        die() ;
    }
    else{
        if($is_featured == 1){
            $confused = "UPDATE topics SET is_featured = 0" ;
            $confused_result = mysqli_query($connect, $confused) ;
        }
        
// set thumbnail name if a new one was uploaded else keep the old one
        $thumbnail_insert = $thumbnail_name ?? $prev_thumbnail_name;

        $query = "UPDATE topics SET topic_title = '$title', text = '$body'. thumbnail='$thumbnail_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1 ";
        $result = mysqli_query($connect, $query);
    } 
    if(!mysqli_errno($connect)){
        $_SESSION['edit-post-success'] = 'Posts updated sucessfully';
    }
}

header('location: '. ROOT_URL . 'admin/dashboard.php');


?> 