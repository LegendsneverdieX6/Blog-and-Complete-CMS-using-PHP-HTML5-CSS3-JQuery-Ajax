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
                if(isset($_POST['submit'])==''){
                    $search = $_POST['search'];

                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $search_query = mysqli_query($connect, $query);

                    if(!$search_query){
                        die('Query Failed' . mysqli_error($connect));
                    }

                    $count = mysqli_num_rows( $search_query );
//                echo "<pre>";
//                print_r($count);
//                echo "</pre>";

                    if($count == 0) {
                        echo '<h1>No Result!<h1>';
                    }else {

                        while( $row = mysqli_fetch_assoc($search_query) ){
                            $post_title = escape($row['post_title']);
                            $post_author = escape($row['post_author']);
                            $post_date = escape($row['post_date']);
                            $post_image = escape($row['post_image']);
                            $post_content = escape($row['post_content']);
                            $post_tags = escape($row['post_tags']);


                ?>

                <h1 class="page-header">
                    Search Result
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php


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
                <?php } }


                } ?>

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