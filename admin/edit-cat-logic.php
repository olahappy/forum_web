
<?php

session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if(!$title || !$description) {
     $_SESSION['edit-cat'] = "Invalid form input on this page";
}
else{
    $query = "UPDATE category SET category_title='$title', category_description='$description', id='$id' LIMIT 1";
    $result = mysqli_query($connect, $query) ;
    if(mysqli_errno($connect)){
        $_SESSION['edit-cat'] = "Cannot update Categories";
    }
    else{
        $_SESSION['edit-cat-success'] = "Category $title updated sucessfully";
    }
}
}

header('location: '. ROOT_URL. 'admin/manage_cat.php')
?>