<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        <?php
        if(isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM category WHERE cat_id = $cat_id";

            $select_cat_id = mysqli_query($connect, $query);
            while( $row = mysqli_fetch_assoc($select_cat_id) ){
                $cat_id = escape($row['cat_id']);
                $cat_title = escape($row['cat_title']);                                           ?>
                <input type="text" name="cat_title" id="cat_title" class="form-control" value="<?php if(isset($cat_title)){echo $cat_title; }?>">
                <?php
            }
        }
        ?>

        <?php //Update Query
        if(isset($_POST['update_cat'])){
            $the_cat_title = escape($_POST['cat_title']);
            $query = "UPDATE category SET cat_title = '{$the_cat_title}' WHERE cat_id = '{$cat_id}' ";
            $update_query = mysqli_query($connect, $query);
            if(!$update_query){
                die("QUERY FAILED" . mysqli_error($connect));
            }
        }

        ?>


    </div>
    <div class="form-group">
        <input type="submit" value="Update Category" class="btn btn-primary" name="update_cat">
    </div>
</form>