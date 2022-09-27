
<?php
include "partials/header.php";

$select = "SELECT * FROM category ORDER BY category_title" ;
$result = mysqli_query($connect, $select) ;
?>
<section class="dashboard">

    <?php if(isset($_SESSION['add-cat-success'])) : ?>
    <div class="alert-message success container">
                <p><?=  $_SESSION['add-cat-success'];
                unset($_SESSION['add-cat-success']);
                 ?>
                 </p>
            </div>
<?php elseif (isset($_SESSION['edit-cat-success'])) : ?>
            <div class="alert-message success container">
                <p><?=  $_SESSION['edit-cat-success'];
                unset($_SESSION['edit-cat-success']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['edit-cat'])) : ?>
            <div class="alert-message error  container">
                <p><?=  $_SESSION['edit-cat'];
                unset($_SESSION['edit-cat']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['delete-cat'])) : ?>
            <div class="alert-message error  container">
                <p><?=  $_SESSION['delete-cat'];
                unset($_SESSION['delete-cat']);
                 ?>
                 </p>
            </div>

            <?php elseif (isset($_SESSION['delete-cat-success'])) : ?>
            <div class="alert-message success  container">
                <p><?=  $_SESSION['delete-cat-success'];
                unset($_SESSION['delete-cat-success']);
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
                    <a href="./manage_users.php">
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
                    <a href="./manage_cat.php" class="active">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Manage categories</h5>
                    </a>
                </li>
                <?php
             endif
                ?>

            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($result) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php   while($results = mysqli_fetch_assoc($result)) : ?> 
  <tr>                
                        <td><?= $results['category_title']?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit_cat.php? id=<?= $results['id'] ?>" class="btn sm">Edit</a> </td>
                        <td>
                        <a href="<?= ROOT_URL ?>admin/delete_cat.php? id=<?= $results['id'] ?>" class="btn sm danger">Delete</a>  
</td>           </tr>
<?php endwhile ?>
                        
                </tbody>
            </table>
            <?php else: ?>
                <div class="alert-message error">
                    <?=  "no categories found" ?>
                </div>
                <?php endif  ?>
        </main>
    </div>
</section>
    
</body>
</html>





<?php
    include "../partials/footer.php"
   ?>