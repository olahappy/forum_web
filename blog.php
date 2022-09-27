
<?php
   include "partials/header.php";

$query = "SELECT * FROM topics ORDER BY date_time DESC";
$posts = mysqli_query($connect, $query);
?>



<section class="search">
    <form action="<?= ROOT_URL  ?>search.php" class="container search-bar" method="GET">
      <div>
        <input type="search" name="search" id="" placeholder="Search">
      </div>
      <button type="submit" class="btn" name="submit">Go</button>
    </form>
</section>

<section class="post cattt">
    <div class="container post-cont">
        <?php  while($post = mysqli_fetch_assoc($posts)) : ?>
         <article class="posts">
            <div class="post_mail">
                <img src="./images/<?= $post['thumbnail']  ?>" alt="">         
             </div>
             <div class="post-info">
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