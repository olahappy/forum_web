
<?php
include "partials/header.php"
?>
    <section class="form-sect">
        <div class="container form-cont">
            <h2>Add Category</h2>
            <?php  
            if(isset($_SESSION['add-cat'])) : ?>
                <div class="alert-message error">
                <p>
                    <?= $_SESSION['add-cat'] ;
                    unset($_SESSION['add-cat'])
                    ?>
                </p>
            </div>
                <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-cat-logic.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="text" id=""placeholder="Title">                
        <textarea  rows="4" name = "description" placeholder="Description"></textarea>
        <button type="submit" name="submit" class="btn">
                    Add Category
        </button>
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>
</body>
</html>