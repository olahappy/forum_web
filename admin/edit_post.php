

<?php
include "partials/header.php";

$fetch = "SELECT * FROM category" ;
$categories = mysqli_query($connect, $fetch) ;

// fetch post from database
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM topics WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $post = mysqli_fetch_assoc($result);
}
else{
    header('location: '. ROOT_URL. 'admin/');
    die();
}
?>



    <section class="form-sect">
        <div class="container form-cont">
            <h2>Edit Posts</h2>
            <div class="alert-message error">
                <p>This is an error message</p>
            </div>
            <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data">
            <input type="hidden" value="<?= $post['id']  ?>"  name="id"> 
            <input type="hidden" value="<?= $post['thumbnail']  ?>"  name="previousthumbnail"> 
                <input type="text" value="<?=  $post['topic_title']?>" id="" placeholder="Title" name="title">                
                <textarea  rows="10" placeholder="Body" name="body"><?= $post['text']?></textarea>
                <select name="category" id="">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['category_title'] ?></option>
                    <?php endwhile ?>
                </select> 
                <div class="form-control">
                    <label for="check" >
                        <input type="checkbox" name="check" id="check" checked value="1">
                        Featured
                    </label>
                 </div>
                 <div class="form-control">
                    <label for="file">
                        Change Thumbnail
                        <input type="file" name="file" id="file">
                    </label>
                 </div>
                <button type="submit" name="submit" class="btn">
                    Update Post
                </button>
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>

   
</body>
</html>