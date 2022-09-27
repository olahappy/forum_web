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
        // var_dump($fetch);
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/'. $avatar_name;
         
        if($avatar_path){
            unlink($avatar_path);
        }
    }
    // delete user posts thumbnail once user deleted
    $thumbnail_query = "SELECT thumbnail FROM topics WHERE author_id = $id";
    $thumbnail_result = mysqli_query($connect, $thumbnail_query)  ;
    if(mysqli_num_rows($thumbnail_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
           $thumbnail_path = '../images/' . $thumbnail['thumbnail'] ;
           // delete thumbnail from images folder if exist
           if($thumbnail_path){
            unlink($thumbnail_path);
           }
        }
    }

    $delete_query = "DELETE FROM userpage WHERE id = $id";
    $delete_result = mysqli_query($connect, $delete_query);
    if(mysqli_errno($connect)){
        $_SESSION['delete-user'] = "Couldn't delete user";
    }
    else{
        $_SESSION['delete-user-success'] = "User deleted successfuly";
    }

}

header('location: '. ROOT_URL. 'admin/manage_users.php')
?>