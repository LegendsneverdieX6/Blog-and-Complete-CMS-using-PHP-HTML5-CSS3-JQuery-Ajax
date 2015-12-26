<?php include('includes/db.php') ?>
<?php include('includes/header.php') ?>


    <!-- Navigation -->
<?php include('includes/nav.php'); ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = '{$the_post_id}'";
            $send_query = mysqli_query($connect, $view_query);
                    confirm($send_query);

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
            }else{
                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} AND post_status = 'published'";
            }

            $select_all_posts = mysqli_query($connect, $query);

            $count = mysqli_num_rows($select_all_posts);
            if($count<1){
                echo "<h1 class='text-center'>No Post Available</h1>";
            }else{



            while( $row = mysqli_fetch_assoc(  $select_all_posts) ){
                $post_title = escape($row['post_title']);
                $post_author = escape($row['post_author']);
                $post_date = escape($row['post_date']);
                $post_image = escape($row['post_image']);
                $post_content = escape($row['post_content']);
                $post_tags = escape($row['post_tags']);

                ?>
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
<!--                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>
            <?php }  } ?>

            <!-- Second Blog Post -->


            <hr>

            <!-- Pager -->
            <?php
                if(isset($_POST['create_comment'])){
                    $the_post_id = $_GET['p_id'];
                    $comment_author = escape($_POST['comment_author']);
                    $comment_email = escape($_POST['comment_email']);
                    $comment_text = escape($_POST['comment_text']);

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_email)){
                        $query = "INSERT into comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES ('{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_text}', 'unapproved', now())" ;

                        $create_comment_query = mysqli_query($connect, $query);
                        confirm($create_comment_query);


                    } else{
                        echo "<script>alert('Any field can\'t be empty')</script>";
                    }


                }
            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <input type="text" name="comment_author" id="" class="form-control" placeholder="Enter your Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="comment_email" id="" class="form-control" placeholder="Enter your email id">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Comment here..." name="comment_text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>


            <!-- Posted Comments -->

            <?php

                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'approve' ";
                $query .= "ORDER BY comment_id DESC ";

                $select_comment_query = mysqli_query($connect, $query);
                confirm($select_comment_query);
                while( $row = mysqli_fetch_assoc($select_comment_query) ) {
                    $comment_date = escape($row['comment_date']);
                    $comment_content = escape($row['comment_content']);
                    $comment_author = escape($row['comment_author']);

                ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <p><?php echo $comment_content; ?></p>
                </div>
            </div>

            <?php }  }?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include('includes/footer.php'); ?>