<?php
    if(isset($_POST['create_post'])){
        $post_title = escape($_POST['post_title']);
        $post_user = escape($_POST['post_user']);
        $post_cat_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);

        $post_image = escape($_FILES['post_image']['name']);
        $post_image_tmp = escape($_FILES['post_image']['tmp_name']);

        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_contents']);
        $post_date = date('d-m-y');


        move_uploaded_file($post_image_tmp, "../images/$post_image");

        $post_query = "INSERT into posts(post_cat_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
        $post_query .= "VALUES('{$post_cat_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";
        $insert_post = mysqli_query($connect, $post_query);

        confirm($insert_post);

        $the_post_id = mysqli_insert_id($connect);


            echo "<p class='bg-success'>Post inserted Successfully. <a target='_blank' href='../post.php?p_id={$the_post_id}'>View
            Post</a>
<a href='posts.php'>Edit More Post</a></p>";


    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" id="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Select Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
            $query_cat = "SELECT * FROM category";
            $select_cat = mysqli_query($connect, $query_cat);

            confirm($select_cat);
            while( $row = mysqli_fetch_assoc($select_cat) ){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
            <?php  }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="" class="form-control">
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
<!--        <label for="post_author">Post Author</label>-->
<!--        <input type="text" name="post_author" id="post_author" class="form-control">-->
<!--    </div>-->
    <div class="form-group">
        <select name="post_status" id="">
            <option value="">Select Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_contents">Post Content</label>
        <textarea name="post_contents" id="post_contents" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="create_post">
    </div>

</form>