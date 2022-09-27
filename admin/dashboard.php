
<?php
include "partials/header.php";
if($_SESSION['user_is_admin'] == true){

}
else{
  header('location: ../index.php') ;
}

$current_id = $_SESSION['user_id'] ;

// $query = "SELECT topics.id ,topics.topic_title , topics.category_id FROM topics";
$query = "SELECT id, topic_title, category_id FROM topics WHERE  author_id = $current_id ORDER BY id DESC";
$users = mysqli_query($connect, $query) ;


?> 

<section class="dashboard">
<?php if(isset($_SESSION['add-post-success'])) : ?>
    <div class="alert-message success container">
                <p><?=  $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                 ?>
                 </p>
            </div>
            <?php elseif(isset($_SESSION['edit-post-success'])) : ?>
    <div class="alert-message success container">
                <p><?=  $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                 ?>
                 </p>
            </div>
            <?php elseif(isset($_SESSION['edit-post'])) : ?>
    <div class="alert-message error container">
                <p><?=  $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                 ?>
                 </p>
            </div>
            <?php elseif(isset($_SESSION['delete-post-success'])) : ?>
    <div class="alert-message success container">
                <p><?=  $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
                 ?>
                 </p>
            </div>
            <?php elseif(isset($_SESSION['delete-post'])) : ?>
    <div class="alert-message error container">
                <p><?=  $_SESSION['delete-post'];
                unset($_SESSION['delete-post']);
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
                    <a href="./dashboard.php" class="active">
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
                    <a href="./manage_users.php" class="">
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
                <li>
                    <a href="./add-comment.php">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Add Comments</h5>
                    </a>
                </li>
                <li>
                    <a href="./comment.php333">
                    <i class="fa-solid fa-pen-to-square"></i>
                          <h5>Manage comments</h5>
                    </a>
                </li>
            <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <?php  
                if(mysqli_num_rows($users)) :
             ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php  while($post = mysqli_fetch_assoc($users)) : ?>  
                        <?php
$cat_id = $post['category_id'];
$cat_query = "SELECT category_title FROM category WHERE id = $cat_id";
$cat_result = mysqli_query($connect, $cat_query);
$category = mysqli_fetch_assoc($cat_result);
?>
  <tr>                
                        <td><?= $post['topic_title'] ?></td>
                        <td><?= $category['category_title'] 
                        ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit_post.php?id=<?= $post['id']  ?>" class="btn sm">Edit</a> </td>
                        <td>
                        <a href="<?= ROOT_URL ?>admin/delete_posts.php?id=<?= $post['id']  ?>" class="btn sm danger">Delete</a>  
</td>          </tr>
                      <?php endwhile ?>         
                </tbody>
            </table>
            <?php   else : ?>
                <div class="alert-message error">
                <?=  "NO POSTS FOUND" ?>
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