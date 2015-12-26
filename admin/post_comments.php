<?php include('includes/admin_header.php'); ?>
<div id="wrapper">

    <?php if($connect){
        //echo "Tamly!";
    }?>

    <!-- Navigation -->
    <?php include('includes/admin_nav.php'); ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Comments
                        <small>Author</small>
                    </h1>
<table class="table table-responsive table-bordered table-hover">
    <thead>
    <th>ID</th>
    <th>Author</th>
    <th>Comment</th>
    <th>Email</th>
    <th>Status</th>
    <th>In Response to</th>
    <th>Date</th>
    <th>Approve</th>
    <th>Unapprove</th>
    <th>Delete</th>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connect, $_GET['id']) . "";
    $select_comments = mysqli_query($connect, $query);
    while( $row = mysqli_fetch_assoc($select_comments)){
        $comment_id = escape($row['comment_id']);
        $comment_post_id = escape($row['comment_post_id']);
        $comment_author = escape($row['comment_author']);
        $comment_email = escape($row['comment_email']);
        $comment_content = escape(substr($row['comment_content'], 0, 50));
        $comment_status = escape($row['comment_status']);
        $comment_date = escape($row['comment_date']);

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post_id = mysqli_query($connect, $query);
        confirm($select_post_id);
        while( $row = mysqli_fetch_assoc($select_post_id) ) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<td><a href='posts.php?p_id=$post_id'>{$post_title}</a></td>";
        }

        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?comment_del=$comment_id&id=". $_GET['id'] ."'>Delete</a></td>";
        echo "</tr>";

    }
    ?>

    </tbody>
</table>

<?php
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status= 'approve' WHERE comment_id = $the_comment_id";
    $unapprove_query = mysqli_query($connect, $query);
    header("Location: comments.php");
}

if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status= 'unapprove' WHERE comment_id = $the_comment_id";
    $unapprove_query = mysqli_query($connect, $query);
    header("Location: comments.php");
}


if(isset($_GET['comment_del'])){
    $the_comment_id = $_GET['comment_del'];

    $query = "DELETE FROM comments WHERE comment_id={$the_comment_id}";
    $delete_query = mysqli_query($connect, $query);
    header("Location: comments.php");
}
?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include('includes/admin_footer.php'); ?>
