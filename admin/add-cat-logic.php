
<?php
session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_POST['submit'])){
    $title = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(empty($title)){
        $_SESSION['add-cat'] = "Enter Title";
    }
    elseif(empty($description)){
        $_SESSION['add-cat'] = "Enter Description";
    }

    if(isset($_SESSION['add-cat'])){
        $_SESSION['add-cat-data'] = $_POST;
        header('location: '. ROOT_URL. 'admin/add_cat.php');
        die();
    }
    else{
        $query = "INSERT INTO category( category_title, category_description ) VALUES('$title', '$description')" ;
        $result = mysqli_query($connect, $query);
        if(mysqli_errno($connect)){
            $_SESSION['add-cat'] = 'Could not add Category';
            header('location:  '. ROOT_URL. 'admin/add_cat.php'); 
            die();
           }         
           else{
             $_SESSION['add-cat-success'] = "Category $title added sucessfully" ;
             header('location:  '. ROOT_URL. 'admin/manage_cat.php'); 
            die();
           }
    }
}
?>