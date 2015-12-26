<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Blog site</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                    $query = "SELECT * FROM category";
                    $select_all_cat = mysqli_query($connect, $query);
                    while( $row = mysqli_fetch_assoc(  $select_all_cat) ){
                         $cat_id = $row['cat_id'];
                         $cat_title = $row['cat_title'];


                        $cat_class = '';
                        $reg_class = '';

                        $pageName = basename($_SERVER['PHP_SELF']);

                        $registration = 'registration.php';

                        if( isset($_GET['category']) && $_GET['category'] == $cat_id ){
                            $cat_class = 'active';
                        } elseif( $pageName == $registration ){
                            $reg_class = 'active';
                        }
                  ?>
                        <li class="<?php echo $cat_class; ?>">
                            <a href="#"><?php echo $cat_title; ?></a>
                        </li>
                <?php
                    }
                ?>
                        <li>
                            <a href="contact.php">Contact</a>
                        </li>

                        <li class="<?php echo $reg_class; ?>">
                            <a href="registration.php">Registration</a>
                        </li>

                        <li>
                            <a href="admin">Admin</a>
                        </li>
                        <li><?php
                            if(isset($_SESSION['user_role'])){
                                if(isset($_GET['p_id'])){
                                    $the_post_id = $_GET['p_id'];
                                    echo "<a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a>";

                                }
                            }

                            ?></li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>