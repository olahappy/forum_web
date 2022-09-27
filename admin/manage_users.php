
<?php
include "partials/header.php";


// fetch all users from database but not current user
$current_id = $_SESSION['user_id'] ;

$query = "SELECT * FROM userpage WHERE NOT id = $current_id";
$users = mysqli_query($connect, $query) ;



?>
<section class="dashboard">

<?php if(isset($_SESSION['add_user-success'])) : ?>
    <div class="alert-message success container">
                <p><?=  $_SESSION['add_user-success'];
                unset($_SESSION['add_user-success']);
                 ?>
                 </p>
            </div>
<?php elseif (isset($_SESSION['edit-user-success'])) : ?>
            <div class="alert-message success container">
                <p><?=  $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['edit-user'])) : ?>
            <div class="alert-message error  container">
                <p><?=  $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['delete-user'])) : ?>
            <div class="alert-message error  container">
                <p><?=  $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['delete-user-success'])) : ?>
            <div class="alert-message success  container">
                <p><?=  $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
                 ?>
                 </p>
            </div>


<?php endif ?>

    <div class="container dashboard-cont">


        <aside>
            <ul>
                <li>
                    <a href="./add_posts.php">
                        <i class="fa-solid fa-pen"></i>
                          <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="./dashboard.php">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php
             if($_SESSION['user_is_admin'] == true) :
                ?>
                <li>
                    <a href="./add_user.php">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Add user</h5>
                    </a>
                </li>
                <li>
                    <a href="./manage_users.php" class="active">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Manage users</h5>
                    </a>
                </li>
                <li>
                    <a href="./add_cat.php">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Add Categories</h5>
                    </a>
                </li>
                <li>
                    <a href="./manage_cat.php" class="">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Manage categories</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php  
                if(mysqli_num_rows($users)) :
             ?>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
  <tr>                
                        <td><?=$user['username'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit_user.php?id=<?= $user['id']  ?>" class="btn sm">Edit</a> </td>
                        <td>
                        <a href="<?= ROOT_URL ?>admin/delete_user.php?id=<?= $user['id']  ?>" class="btn sm danger">Delete</a>  
</td>  
<td><?= $user['forum_notify'] ? 'Yes': 'No' ?>
</td>   
</tr>
                      <?php endwhile ?>
                        
                </tbody>
            </table>
        <?php  else : ?>
            <div class="alert-message error">
                <?=  "NO USERS FOUND" ?>
            </div> 
        <?php  endif ?>
        </main>
    </div>
</section>
    
</body>
</html>













<?php
    include "../partials/footer.php"
   ?>