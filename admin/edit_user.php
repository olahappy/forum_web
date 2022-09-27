
<?php
include "partials/header.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
    $query = "SELECT * FROM userpage WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $fetch = mysqli_fetch_assoc($result);
}
else{
    header('location: '.ROOT_URL. 'admin/manage_users.php');
    die();
}
?>

<section class="form-sect">
            
        <div class="container form-cont">
            <h2>Edit user</h2>
            
            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php"  method="POST">
            <input type="hidden" name="id" id="" placeholder="" value="<?= $fetch['id']  ?>"> 
            <input type="text" name="username" id="" placeholder="Username" value="<?= $fetch['username']  ?>"> 
            <select name="select" id="">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select> 
                <button type="submit" name="submit" class="btn">
                    Update user
                </button>
            </form>
        </div>
    </section> 

<?php
    include "../partials/footer.php"
   ?>