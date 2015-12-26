<?php
if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_by_id = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = escape($row['user_id']);
        $user_name = escape($row['user_name']);
        $user_firstname = escape($row['user_firstname']);
        $user_lastname = escape($row['user_lastname']);
        $user_password = escape($row['user_pass']);
        $user_email = escape($row['user_email']);
        $user_role = escape($row['user_role']);
    }


    if(isset($_POST['update_user'])){
        $user_id = escape($_POST['user_id']);
        $user_fname = escape($_POST['user_fname']);
        $user_lname = escape($_POST['user_lname']);
        $user_name = escape($_POST['user_name']);
        $user_email = escape($_POST['user_email']);
        $user_pass = escape($_POST['user_pass']);
        $user_role = escape($_POST['user_role']);

        if(!empty($user_pass)){
            $query_password = "SELECT user_pass FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connect, $query_password);
            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_pass'];


                if($db_user_password != $user_pass) {
                    $hashed_password = password_hash( $user_pass, PASSWORD_BCRYPT, array('cost' => 10) );
                }
                    $query = "UPDATE users SET ";
                    $query .="user_firstname = '{$user_fname}', ";
                    $query .="user_lastname = '{$user_lname}', ";
                    $query .="user_name = '{$user_name}', ";
                    $query .="user_email = '{$user_email}', ";
                    $query .="user_pass = '{$hashed_password}', ";
                    $query .="user_role = '{$user_role}' ";
                    $query .="WHERE user_id = '{$the_user_id}'";

                    $update_user = mysqli_query($connect, $query);
                    confirm($update_user);

                    echo "User Updated" . "<a href='users.php'>View Users</a>";

                }


    }
} else{
    header("Location: index.php");
}

    ?>

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
        <label for="user_role">Select User Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <?php
                echo "<option value='$user_role'>$user_role</option>";
                if($user_role == "admin"){
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

