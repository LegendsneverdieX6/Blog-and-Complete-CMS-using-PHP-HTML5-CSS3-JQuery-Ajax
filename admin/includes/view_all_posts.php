<?php include('delete_modal.php');?>
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
                        $post_title = escape($row['post_title']);
                        $post_author = escape($row['post_author']);
                        $post_cat_id = escape($row['post_cat_id']);
                        $post_status = escape($row['post_status']);

                        $post_image = escape($row['post_image']);

                        $post_tags = escape($row['post_tags']);
                        $post_content = escape($row['post_contents']);

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
        <th>User</th>
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
            $post_id = escape($row['post_id']);
            $post_author = escape($row['post_author']);
            $post_user = escape($row['post_user']);
            $post_title = escape($row['post_title']);
            $post_category_id = escape($row['post_cat_id']);
            $post_status = escape($row['post_status']);
            $post_image = escape($row['post_image']);
            $post_tags = escape($row['post_tags']);
            $post_comments = escape($row['post_comment_count']);
            $post_date = escape($row['post_date']);
            $post_views_count = escape($row['post_views_count']);
            echo "<tr>";
           ?>

            <td><input type='checkbox' name='checkBoxArray[]' class='checkbox' value="<?php echo $post_id; ?>"></td>

            <?php
            echo "<td>$post_id</td>";

            if(!empty($post_author)){
                echo "<td>$post_author</td>";
            }elseif(!empty($post_user)){
                echo "<td>$post_user</td>";
            }


            echo "<td>$post_title</td>";

            $query = "SELECT * FROM category WHERE cat_id = {$post_category_id}";
            $select_cat_id = mysqli_query($connect, $query);
            confirm($select_cat_id);
            while( $row = mysqli_fetch_assoc($select_cat_id) ) {
                $cat_id = escape($row['cat_id']);
                $cat_title = escape($row['cat_title']);

                echo "<td>{$cat_title}</td>";
            }


            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
            echo "<td>$post_tags</td>";
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($connect, $query);
            $row = mysqli_fetch_array($send_comment_query);
            $comment_id = $row['comment_id'];
            $count_comment = mysqli_num_rows($send_comment_query);
            echo "<td><a href='post_comments.php?id=$post_id'>$count_comment</a></td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a
onclick=\"javascript: return confirm('Are you sure you want to reset post views count!!');\"href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
//            echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete post!!');\"
//href='posts.php?post_del={$post_id}'>Delete</a></td>
//";
        echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";

            echo "</tr>";



        }
        ?>

        </tbody>
    </table>
</form>
<?php
    if(isset($_GET['post_del'])){
        if(isset($_SESSION['user_role']) == 'admin'){
            $the_post_id = escape($_GET['post_del']);

            $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
            $delete_query = mysqli_query($connect, $query);
            header("Location: posts.php");
        }

    }

if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connect, $query);
    header("Location: posts.php");
}
?>

<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");

            var delete_url = "posts.php?post_del"+ id +" ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal("show");
    });
    });
</script>

