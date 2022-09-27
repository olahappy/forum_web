
<?php
include "partials/header.php";

if(isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;

  $query = "SELECT * FROM category where id = $id";
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) == 1){
    $category = mysqli_fetch_assoc($result) ;
  }
}
else{
    header('location: '. ROOT_URL. 'admin/manage_cat.php') ;
}
?>

    <section class="form-sect">
        <div class="container form-cont">
            <h2>Edit Category</h2>
            <form action="<?= ROOT_URL ?>admin/edit-cat-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?=  $category['id']?>">
        <input type="text" name="text" value="<?=  $category['category_title'] ?>" id="" placeholder="Title">                
        <textarea  rows="4" name = "description" placeholder="Description"><?=  $category['category_description'] ?></textarea>
        <button type="submit" name="submit" class="btn">
                    Update Category
        </button>
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>

   
</body>
</html>