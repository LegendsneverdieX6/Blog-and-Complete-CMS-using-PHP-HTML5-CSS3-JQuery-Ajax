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
                    $the_post_author = $_GET['author'];
                }
            ?>
            <!-- First Blog Post -->
            <?php
            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $select_all_posts = mysqli_query($connect, $query);


            while( $row = mysqli_fetch_assoc(  $select_all_posts) ){
                $post_title = escape($row['post_title']);
                $post_author = escape($row['post_user']);
                $post_date = escape($row['post_date']);
                $post_image = escape($row['post_image']);
                $post_content = escape($row['post_content']);
                $post_tags = escape($row['post_tags']);

                ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    All post by <?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
<!--                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>
            <?php } ?>

            <!-- Second Blog Post -->


            <hr>

            <!-- Pager -->



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include('includes/footer.php'); ?>