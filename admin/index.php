<?php include('includes/admin_header.php'); ?>

    <div id="wrapper">


        <!-- Navigation -->
       <?php include('includes/admin_nav.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $count_user;?>
                            Welcome to Admin Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                        $select_query = mysqli_query($connect, $query);
                                        $post_count = mysqli_num_rows($select_query);
                                        ?>

                                        <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $select_query_comment = mysqli_query($connect, $query);
                                        $comment_count = mysqli_num_rows($select_query_comment);
                                        ?>
                                        <div class='huge'><?php echo $comment_count; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $select_query_user = mysqli_query($connect, $query);
                                        $user_count = mysqli_num_rows($select_query_user);
                                        ?>
                                        <div class='huge'><?php echo $user_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM category";
                                        $select_query_category = mysqli_query($connect, $query);
                                        $category_count = mysqli_num_rows($select_query_category);
                                        ?>
                                        <div class='huge'><?php echo $category_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                $select_all_published_post = mysqli_query($connect, $query);
                $published_post_count = mysqli_num_rows($select_all_published_post);

                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_post = mysqli_query($connect, $query);
                    $draft_post_count = mysqli_num_rows($select_all_draft_post);

                    $query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
                    $select_all_draft_comment = mysqli_query($connect, $query);
                    $draft_comment_count = mysqli_num_rows($select_all_draft_comment);

                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_all_draft_user = mysqli_query($connect, $query);
                    $draft_user_count = mysqli_num_rows($select_all_draft_user);


                ?>

                <div class="row">
                    <script type="text/javascript">
                        google.load("visualization", "1.1", {packages:["bar"]});
                        google.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                    $elements_text = array('All Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users',
                                    'Unapproved Users', 'Comments', 'Pending Comments');
                                    $elements_count = array($post_count, $published_post_count, $draft_post_count, $category_count,
                                    $user_count, $draft_user_count, $comment_count, $draft_comment_count);

                                    for($i = 0; $i < 8; $i++){
                                        echo "['{$elements_text[$i]}'" . "," . "'{$elements_count[$i]}'],";
                                    }
                                ?>

                               // ['Posts', 1000],

                            ]);

                            var options = {
                                chart: {
                                    title: 'CMS Performance',
                                    subtitle: 'Total: Active Posts, Categories, Users, Comments',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                    </script>
                    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include('includes/admin_footer.php'); ?>