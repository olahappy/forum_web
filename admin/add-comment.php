<?php
include "partials/header.php"
?>
    <section class="form-sect">
        <div class="container form-cont">
            <h2>Add Comments</h2>
            <?php  
            if(isset($_SESSION['add-comment'])) : ?>
                <div class="alert-message error">
                <p>
                    <?= $_SESSION['add-comment'] ;
                    unset($_SESSION['add-comment'])
                    ?>
                </p>
            </div>
                <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-comment-logic.php"  method="POST">              
        <textarea  rows="4" name = "description" placeholder="Comment"></textarea>
        <button type="submit" name="submit" class="btn">
                    Add Comments
        </button>
            </form>
        </div>
    </section> 
    <?php
    include "../partials/footer.php"
   ?>
</body>
</html>