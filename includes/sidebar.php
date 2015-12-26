<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="post">
            <div class="input-group">

                <input type="text" class="form-control" name="search" />
                            <span class="input-group-btn" name="submit">
                                <button class="btn btn-default" type="button" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>

            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <div class="well">

        <?php if(isset($_SESSION['user_role'])):?>
        <h4>Logged in as <?php echo $_SESSION['username'];?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Log Out</a>

        <?php else: ?>

            <form action="includes/login.php" method="post">
                <div class="form-group">

                    <input type="text" class="form-control" name="username" placeholder="Enter username"/>

                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="userpass" placeholder="Password"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </div>
            </form>
        <!-- /.input-group -->
        <?php endif; ?>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM category";
                    $select_all_cat = mysqli_query($connect, $query);
                    while( $row = mysqli_fetch_assoc(  $select_all_cat) ){
                        $cat_id = escape($row['cat_id']);
                        $cat_title = escape($row['cat_title']);

                        ?>
                        <li>
                            <a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include('widgets.php'); ?>

</div>