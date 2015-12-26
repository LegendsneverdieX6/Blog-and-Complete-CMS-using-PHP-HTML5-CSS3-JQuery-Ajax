<?php include('includes/admin_header.php'); ?>
<?php
    if(isset($_SESSION['username'])){
        $user_name = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";

        $select_user_profile = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($select_user_profile)){
            $user_id = escape($row['user_id']);
            $user_name = escape($row['user_name']);
            $user_firstname = escape($row['user_firstname']);
            $user_lastname = escape($row['user_lastname']);
            $user_email = escape($row['user_email']);
            $user_password = escape($row['user_pass']);
            $user_role = escape($row['user_role']);

        }
    }
?>

<?php
if(isset($_POST['update_user'])){
    $user_id = escape($_POST['user_id']);
    $user_fname = escape($_POST['user_fname']);
    $user_lname = escape($_POST['user_lname']);
    $user_name = escape($_POST['user_name']);
    $user_email = escape($_POST['user_email']);
    $user_pass = escape($_POST['user_pass']);
    $user_role = escape($_POST['user_role']);

    $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_fname}', ";
    $query .="user_lastname = '{$user_lname}', ";
    $query .="user_name = '{$user_name}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_pass = '{$user_pass}', ";
    $query .="user_role = '{$user_role}' ";
    $query .="WHERE user_name = '{$user_name}'";

    $update_user = mysqli_query($connect, $query);
    confirm($update_user);
    header("Location: profile.php");

}

?>
    <div id="wrapper">

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

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="post_author">First Name</label>
                            <input type="text" value='<?php echo $user_firstname; ?>' name="user_fname" id="user_fname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="post_status">Last Name</label>
                            <input type="text" value='<?php echo $user_lastname; ?>' name="user_lname" id="user_lname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_role">Select Category</label>
                            <select name="user_role" id="user_role" class="form-control">
                                <?php

                                echo "<option value='admin'>$user_role</option>";
                                if($user_role == 'admin'){
                                    echo "<option value='subscriber'>subscriber</option>";
                                }else{
                                    echo "<option value='admin'>admin</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" value='<?php echo $user_name; ?>' name="user_name" id="user_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" value='<?php echo $user_email; ?>' name="user_email" id="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_pass">Password</label>
                            <input type="password" value='<?php echo $user_password; ?>' name="user_pass" id="user_pass" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update User" class="btn btn-primary" name="update_user">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include('includes/admin_footer.php'); ?>