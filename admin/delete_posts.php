<?php   

session_start();
define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM userpage WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $fetch = mysqli_fetch_assoc($result);


    if(mysqli_num_rows($result) == 1){
        $thumbnail_name = $fetch['thumbnail'];
        $thumbnail_path = '../images/'. $thumbnail_name;
         
        if($thumbnail_path){
            unlink($thumbnail_path);
        }
    }

   $delete_query = "DELETE FROM topics WHERE id = $id";
    $delete_result = mysqli_query($connect, $delete_query);
    if(mysqli_errno($connect)){
        $_SESSION['delete-post'] = "Couldn't delete category";
    }
    else{
        $_SESSION['delete-post-success'] = "Category deleted successfuly";
    }

}
header('location: '. ROOT_URL. 'admin/dashboard.php');
die();

?>
