<?php   

session_start();
define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // update category_id of posts that belong to this category of id 
    $update_query = "UPDATE topics SET category_id = 17 WHERE category_id = $id" ;
    $update_result = mysqli_query($connect, $update_query);

    if(!mysqli_errno($connect)){
        $delete_query = "DELETE FROM category WHERE id = $id LIMIT 1";
        $delete_result = mysqli_query($connect, $delete_query);
    }

  
    if(mysqli_errno($connect)){
        $_SESSION['delete-cat'] = "Couldn't delete category";
    }
    else{
        $_SESSION['delete-cat-success'] = "Category deleted successfuly";
    }

}
header('location: '. ROOT_URL. 'admin/manage_cat.php');
die();

?>