<?php include('includes/db.php') ?>
<?php include('includes/header.php') ?>

    <!-- Navigation -->
    <?php include('includes/nav.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

<!--                <h1 class="page-header">-->
<!--                    Page Heading-->
<!--                    <small>Secondary Text</small>-->
<!--                </h1>-->

                <!-- First Blog Post -->
                <?php

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else{
                        $page = "";
                    }

                    $per_page = 3;

                    if($page =="" || $page == 1){
                        $page_1 = 0;
                    } else{
                        $page_1 = ($page * $per_page) - $per_page;
                    }

                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                        $post_query_count = "SELECT * FROM posts ";
                    }else{
                        $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                    }


                    $find_count = mysqli_query($connect, $post_query_count);

                    $count = mysqli_num_rows($find_count);

                    if( $count < 1 ){
                        echo "<h1 class='text-center'>No Post Available</h1>";
                    } else{
                         $count = ceil($count / 5);

                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $query .= "ORDER BY post_id DESC ";
                    $query .= "LIMIT $page_1, $per_page";
                    //$query .= "ORDER BY post_id DESC LIMIT 0, 5";
                    $select_all_posts = mysqli_query($connect, $query);
                    while( $row = mysqli_fetch_assoc(  $select_all_posts) ){
                         $post_id = escape($row['post_id']);
                         $post_title = escape($row['post_title']);
                         $post_author = escape($row['post_user']);
                         $post_date = escape($row['post_date']);
                         $post_image = escape($row['post_image']);
                         $post_content = escape(substr($row['post_content'], 0, 100));
                         $post_tags = escape($row['post_tags']);
                        $post_status = escape($row['post_status']);

                        if($post_status == ('published' || 'Published' || 'PUBLISHED')){
                           ?>
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id; ?>">
                                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                            </a>
                            <hr>
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr> <?php
                        } else{
                            // Say something
                  ?>

                <?php }  }  }?>



                <!-- Second Blog Post -->


                <hr>


                <!-- Pager -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">

            <?php
                for($i = 1; $i <= $count; $i++){

                if($i == $page){
                    echo "<li class='active_link'><a href='index.php?page={$i}'>$i</a></li>";
                } else{
                    echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                }
                }
            ?>

        </ul>

       <?php include('includes/footer.php'); ?>