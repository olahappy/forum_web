
<?php
include "partials/header.php";

$fetch = "SELECT * FROM category" ;
$categories = mysqli_query($connect, $fetch) ;

$title = $_SESSION['add-post-data']['topic_title'] ?? null; 
$body = $_SESSION['add-post-data']['text'] ?? null; 

unset($_SESSION['add-post-data']);
?>

    <section class="form-sect">
        <div class="container form-cont">
            <h2>Add Posts</h2>
            <?php if(isset($_SESSION['add-post']))  :  ?>
            <div class="alert-message error">
                <p><?= $_SESSION['add-post'] ;
                unset($_SESSION['add-post']) ?></p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="text" id="" placeholder="Title" value="<?= $title  ?>">                
                <textarea  rows="10" placeholder="Body" name="body" value="<?= $body   ?>" ></textarea>              
                <select name="category" id="">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['category_title'] ?> </option>
                   <?php endwhile ?>
                </select> 
                
                <div class="form-control">
                    <label for="is_featured" >
                        <input type="checkbox" name="is_featured" id="is_featured" checked value="1">
                        Featured
                    </label>
                 </div>
                 
                 <div class="form-control">
                    <label for="file">
                        Add Thumbnail
                        <input type="file" name="thumbnail" id="file">
                    </label>
                 </div>
                <button type="submit" name="submit" class="btn">
                    Add Posts
                </button>
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>
</body>
</html>


<?php if(isset($_SESSION['user_is_admin'])): ?>
    <?php endif ?>