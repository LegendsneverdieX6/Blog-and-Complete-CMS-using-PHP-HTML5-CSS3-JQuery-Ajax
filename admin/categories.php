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
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                            <?php
                                insert_categories();
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" name="cat_title" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                                </div>
                            </form>
                            <?php
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];

                                    include "includes/update_cat.php";
                                }
                            ?>


                        </div>
                        <div class="col-xs-6">

                            <table class="table table-bordered table-responsive table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                //find all categories
                               findAllCategories();
                                        ?>

                                <?php //delete Query
                                    delete_categories();

                                ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include('includes/admin_footer.php'); ?>