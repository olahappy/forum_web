<?php
include "partials/header.php";

$select = "SELECT * FROM comment " ;
$result = mysqli_query($connect, $select) ;
?>



<section class="comment-sect">
<main>
<h2>All comments </h2>
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
                        <td><?= $results['body']?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit_comment.php? id=<?= $results['id'] ?>" class="btn sm">Edit</a> </td>
                        <td>
                        <a href="<?= ROOT_URL ?>admin/delete_comment.php? id=<?= $results['id'] ?>" class="btn sm danger">Delete</a>  
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



<div class="comment-div">
<a href="<?= ROOT_URL ?>admin/add-comment.php"><button class="comment-btn btn">
  Add Comment
</button>
</a>
</div>


</section>
</body>
</html>