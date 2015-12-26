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
            if(isset($_GET['category'])){
                $the_cat_id = $_GET['category'];
            }
            ?>
            <!-- First Blog Post -->
            <?php
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $query = "SELECT * FROM posts WHERE post_cat_id = {$the_cat_id} ";
            }else{
                $query = "SELECT * FROM posts WHERE post_cat_id = {$the_cat_id} AND post_status = 'published'";
            }

            $select_all_posts = mysqli_query($connect, $query);
            $count = mysqli_num_rows($select_all_posts);
            if($count > 0) {
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
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>

            <!-- Second Blog Post -->


            <hr>

            <!-- Pager -->
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <?php } else{
                echo "<h1 class='text-center'>No Post Available</h1>";
            }?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include('includes/footer.php'); ?>