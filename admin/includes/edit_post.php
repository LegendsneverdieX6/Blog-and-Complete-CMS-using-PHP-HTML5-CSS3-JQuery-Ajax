<?php
if(isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = escape($row['post_id']);
        $post_user = escape($row['post_user']);
        $post_title = escape($row['post_title']);
        $post_category = escape($row['post_category']);
        $post_status = escape($row['post_status']);
        $post_image = escape($row['post_image']);
        $post_tags = escape($row['post_tags']);
        $post_comments = escape($row['post_comments']);
        $post_date = escape($row['post_date']);
        $post_content = escape($row['post_content']);
    }

    if(isset($_POST['update_post'])){
        $post_id = escape($_POST['post_id']);
        $post_user = escape($_POST['post_user']);
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);
        $post_image = escape($_FILES['post_image']['name']);
        $post_image_tmp = escape($_FILES['post_image']['tmp_name']);
        $post_tags = escape($_POST['post_tags']);
        $post_comments = escape($_POST['post_comments']);
        $post_date = escape($_POST['post_date']);
        $post_content = escape($_POST['post_content']);

        move_uploaded_file($post_image_tmp, "../images/$post_image");

        if(empty($post_image)){
            $query ="SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connect, $query );
            while( $row = mysqli_fetch_assoc($select_image) ){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_cat_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_user = '{$post_user}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags = '{$post_tags}', ";
        $query .="post_content = '{$post_content}', ";
        $query .="post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id}";

        $update_post = mysqli_query($connect, $query);
        confirm($update_post);

        if($update_post){
            echo "<p class='bg-success'>Post Updated Successfully. <a href='../post.php?p_id={$the_post_id}'>View
            Post</a>
<a href='posts.php'>Edit More Post</a></p>";
        }

    }
}
    ?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" name="post_title" id="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
                $query_cat = "SELECT * FROM category";
                $select_cat = mysqli_query($connect, $query_cat);

                confirm($select_cat);
                while( $row = mysqli_fetch_assoc($select_cat) ){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    if($cat_id == $post_category_id){
                        echo "<option selected value='$cat_id '>$cat_title</option>";
                    }else{
                        echo "<option value='$cat_id '>$cat_title</option>";
                    }
               }
            ?>
        </select>

    </div>

    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="" class="form-control">

            <option value="<?php echo $post_user; ?>"><?php echo $post_user; ?></option>
            <?php
            $query_user = "SELECT * FROM users";
            $select_users = mysqli_query($connect, $query_user);

            confirm($select_users);
            while( $row = mysqli_fetch_assoc($select_users) ){
                $user_id = escape($row['user_id']);
                $user_name = escape($row['user_name']);
                ?>
                <option value="<?php echo $user_name; ?>"><?php echo $user_name; ?></option>
            <?php  }
            ?>
        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="post_user">Post Author</label>-->
<!--        <input value="--><?php //echo $post_user; ?><!--"type="text" name="post_user" id="post_user" class="form-control">-->
<!--    </div>-->
    <div class="form-group">
        <label for="post_status">Post Status</label>

        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            if($post_status =='draft'){
            echo "<option value='published'>Published</option>";
            } else{
                echo "<option value='draft'>Draft</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width='100' src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="post_image" id="" class="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_contents">Post Content</label>
        <textarea name="post_content" id="post_content" class="form-control" cols="30" rows="10"><?php echo
            $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="update_post">
    </div>

</form>

