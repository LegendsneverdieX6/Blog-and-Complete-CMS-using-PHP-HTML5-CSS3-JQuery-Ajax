<?php
if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_by_id = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_password = $row['user_pass'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }



    if(isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
        $user_role = $_POST['user_role'];

        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connect, $query);
        confirm($select_randSalt_query);

        $row = mysqli_fetch_array($select_randSalt_query);
        $salt = $row['randSalt'];

        $hash_pass = crypt($user_pass, $salt);

        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_fname}', ";
        $query .="user_lastname = '{$user_lname}', ";
        $query .="user_name = '{$user_name}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_pass = '{$hash_pass}', ";
        $query .="user_role = '{$user_role}' ";
        $query .="WHERE user_id = '{$the_user_id}'";

        $update_user = mysqli_query($connect, $query);
        confirm($update_user);
        header("Location: users.php");

    }
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

