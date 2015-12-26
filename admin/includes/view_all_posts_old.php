<?php
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueid){
            $bulk_option = $_POST['bulk_option'];

            switch($bulk_option){
                case 'published' :
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueid}";
                    $update_to_publish_status = mysqli_query($connect, $query);
                    confirm($update_to_publish_status);
                    break;

                case 'draft' :
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueid}";
                    $update_to_draft_status = mysqli_query($connect, $query);
                    confirm($update_to_draft_status);
                    break;
                case 'delete' :
                    $query = "DELETE FROM posts WHERE post_id = {$postValueid}";
                    $delete_post = mysqli_query($connect, $query);
                    confirm($delete_post);
                    break;
                case 'clone' :
                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueid}'";
                    $select_post_query = mysqli_query($connect, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_cat_id = $row['post_cat_id'];
                        $post_status = $row['post_status'];

                        $post_image = $row['post_image'];

                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_contents'];

                    }



                    $query = "INSERT into posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                    $query .= "VALUES('{$post_cat_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";
                    $copy_query = mysqli_query($connect, $query);

                    confirm($copy_query);
                    break;
            }
        }
    }
?>
<form action="" method="post">
    <table class="table table-responsive table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select name="bulk_option" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="form-group col-xs-4">
            <input type="submit" value="Apply" class="btn btn-success" name="submit">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
        <th><input type="checkbox" name="" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tages</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Post Views count</th>
        </thead>
        <tbody>
        <?php


        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connect, $query);
        while( $row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_views_count = $row['post_views_count'];
            echo "<tr>";
           ?>

            <td><input type='checkbox' name='checkBoxArray[]' class='checkbox' value="<?php echo $post_id; ?>"></td>

            <?php
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";

            $query = "SELECT * FROM category WHERE cat_id = {$post_category_id}";
            $select_cat_id = mysqli_query($connect, $query);
            confirm($select_cat_id);
            while( $row = mysqli_fetch_assoc($select_cat_id) ) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";
            }


            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comments</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a
onclick=\"javascript: return confirm('Are you sure you want to reset post views count!!');\"href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete post!!');\"
href='posts.php?post_del={$post_id}'>Delete</a></td>";
            echo "</tr>";



        }
        ?>

        </tbody>
    </table>
</form>
<?php
    if(isset($_GET['post_del'])){
        $the_post_id = $_GET['post_del'];

        $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
        $delete_query = mysqli_query($connect, $query);
        header("Location: posts.php");
    }

if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connect, $query);
    header("Location: posts.php");
}
?>

