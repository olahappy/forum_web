
<?php
include "partials/header.php";


$username = $_SESSION['add_user-data']['username'] ?? null;
$email = $_SESSION['add_user-data']['email'] ?? null;
$password = $_SESSION['add_user-data']['password'] ?? null;
$cpassword = $_SESSION['add_user-data']['cpassword'] ?? null;
// $in = $_SESSION['add_user-data']['select'] ?? null;
unset($_SESSION['add_user-data']);
?>


    <section class="form-sect">
        <div class="container form-cont">
            <h2>Add user</h2>
            <?php 
            if(isset($_SESSION['add_user'])) : ?>
                <div class="alert-message error">
                <p>
                    <?= $_SESSION['add_user'] ; 
                    unset( $_SESSION['add_user']);?>
                </p>
            </div>
             <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="username" id="" placeholder="Username" value="<?= $username ?>"> 
                <input type="email" name="email" id="" placeholder="Email" value="<?= $email ?>">
                <input type="password" name="password" id="" placeholder="Password" value="<?= $password ?>">
                <input type="password" name="cpassword" id="" placeholder="Confirm password" value="<?= $cpassword ?>">
                <select name="select" id="">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form-control">
                    <label for="avatar">
                        <input type="file" name="avatar" id="avatar">
                    </label>
                </div>
                <button type="submit" name="submit" class="btn">
                    Add user
                </button>
                
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>


  
</body>
</html>