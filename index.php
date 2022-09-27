 
<?php

include 'partials/header.php';
$featured = "SELECT * FROM topics WHERE is_featured = 1";
$f_result = mysqli_query($connect, $featured);
$f_query = mysqli_fetch_assoc($f_result);

$query = "SELECT * FROM topics ORDER BY date_time LIMIT 9";
$posts = mysqli_query($connect, $query);

?>

<?php  if(mysqli_num_rows($f_result) == 1)  :?>
<section class="featured">
   <div class="container feat-cont">
       <div class="post_mail">
          <img src="./images/<?= $f_query['thumbnail']   ?>" alt="">         
       </div>
       <div class="post-info">
        <?php    
     $cat_id = $f_query['category_id'];
     $cat_query = "SELECT * FROM category WHERE id = $cat_id";
     $cat_result = mysqli_query($connect, $cat_query);
     $category = mysqli_fetch_assoc($cat_result);

?>
            <a href="<?= ROOT_URL ?>cat_posts.php?id=<?= $f_query['id']  ?>" class="cat-btn"><?= $category['category_title']   ?></a>
            <h2 class="post-title">
                <a href="<?=  ROOT_URL ?>posts.php?id=<?=  $f_query['id']  ?>"><?=  $f_query['topic_title']?></a>
            </h2>
            <p class="post-body">
                <?=  $f_query['text'] ?> 
            </p>
            <div class="post-author">
                <?php
              $author_id = $f_query['author_id'];
              $author_query = "SELECT * FROM userpage WHERE id = $author_id  ";
     $author_result = mysqli_query($connect, $author_query);
     $author = mysqli_fetch_assoc($author_result);
?>
                <div class="author-avatar">
                    <img src="./images/<?= $author['file']   ?>" alt="">               
                </div>
                <div class="author-info">
                    <h5>By : <?=  $author['username']  ?></h5>
                    <small><?= date("M d, Y - H:i", strtotime($f_query['date_time']))   ?></small>
                </div>
            </div>
       </div>
   </div>
</section>
<?php endif ?>

<section class="post <?= $f_query ? '' : 'extra_margin' ?>">
    <div class="container post-cont">
        <?php  while($post = mysqli_fetch_assoc($posts)) : ?>
         <article class="posts">
            <div class="post_mail">
                <img src="./images/<?= $post['thumbnail']  ?>" alt="">         
             </div>
             <div class="post-info">
             <?php    
     $cats_id = $post['category_id'];
     $cat_query = "SELECT * FROM category WHERE id = $cats_id ";
     $cat_result = mysqli_query($connect, $cat_query);
     $category = mysqli_fetch_assoc($cat_result);

?>
               <a href="<?= ROOT_URL ?>cat_posts.php?id=<?= $post['category_id']  ?>" class="cat-btn"><?= $category['category_title']   ?></a>
                <h3 class="post-title">
                    <a href="<?=  ROOT_URL ?>posts.php?id=<?=  $post['id']  ?>"><?=  $post['topic_title'] ?></a>
                </h3>
                <p class="post-body">
                  <?= $post['text']  ?>
                </p>
                <div class="post-author">
                <?php
              $author_id = $post['author_id'];
              $author_query = "SELECT * FROM userpage WHERE id = $author_id  ";
     $author_result = mysqli_query($connect, $author_query);
     $author = mysqli_fetch_assoc($author_result);
?>
                    <div class="author-avatar">
                        <img src="./images/<?= $author['file']  ?>" alt="">
                    </div>
                    <div class="author-info">
                    <h5>By : <?=  $author['username']  ?></h5>
                    <small><?= date("M d, Y - H:i", strtotime($post['date_time']))   ?></small>
                    </div>
                </div>
           </div>
           
         </article>
         <?php  endwhile ?>
    </div>
</section>

<section class="category">
    <div class="container cat-btns">
        <?php 
$all_cat = "SELECT * FROM category";
$all_cat_result = mysqli_query($connect, $all_cat);
?>
<?php while($all_category = mysqli_fetch_assoc($all_cat_result)) : ?>
        <a href="<?= ROOT_URL ?>cat_posts.php?id=<?= $all_category['id']?>" class="cat-btn"><?= $all_category['category_title']  ?></a>
        <?php endwhile  ?>
    </div>
</section>


<?php
include "partials/footer.php";
?>

</body>
</html>