

<?php
   include "partials/header.php";

   // fetch post
   if(isset($_GET['id'])){
     $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
     $query = "SELECT * FROM topics where id = $id";
     $result = mysqli_query($connect, $query);
     $post = mysqli_fetch_assoc($result);
   }
   else{
    header('location: '. ROOT_URL. 'blog.php');
    die();
   }
?>

    <section class="single-post">
        <div class="container single-post-cont">
            <h2><?=  $post['topic_title']  ?></h2>
            <div class="post-author">
            <?php
              $author_id = $post['author_id'];
              $author_query = "SELECT * FROM userpage WHERE id = $author_id  ";
     $author_result = mysqli_query($connect, $author_query);
     $author = mysqli_fetch_assoc($author_result);
?>
                <div class="author-avatar">
                    <img src="./images/<?=  $author['file']  ?>" alt="">
                </div>
                <div class="author-info">
                    <h5>By <?= $author['username']   ?></h5>
                    <small><?= date("M d, Y - H:i", strtotime($post['date_time']))   ?></small>
                </div>
            </div>
            <div class="singlepost-mail">
                <img src="./images/<?= $post['thumbnail']  ?>" alt="">  
            </div>
            <p class="hungry">
                <?= $post['text']  ?>
            </p>
            
        <a href="<?= ROOT_URL ?>admin/comment.php">
           <div class="comment">
           <i class="fa-solid fa-2x fa-comment"></i>
           <p>Comments</p>
           </div>
           </a>
        </div>
    </section>


    <?php
include "partials/footer.php";
?>


</body>
</html>