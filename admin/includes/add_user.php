<?php
    if(isset($_POST['create_user'])){
        $user_id = escape($_POST['user_id']);
        $user_fname = escape($_POST['user_fname']);
        $user_lname = escape($_POST['user_lname']);
        $user_name = escape($_POST['user_name']);

        $user_email = escape($_POST['user_email']);
        $user_pass = escape($_POST['user_pass']);
        $user_role = escape($_POST['user_role']);

        $user_password = password_hash( $user_pass, PASSWORD_BCRYPT, array('cost' => 10) );

        $user_query = "INSERT into users(user_id, user_firstname, user_lastname, user_name, user_email, user_pass, user_role) ";
        $user_query .= "VALUES('{$user_id}','{$user_fname}','{$user_lname}','{$user_name}','{$user_email}','{$user_password}','{$user_role}' ) ";
        $insert_user = mysqli_query($connect, $user_query);

        confirm($insert_user);

        echo "User Created." . " " . "<a href='users.php'>View Users</a>";

    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">First Name</label>
        <input type="text" name="user_fname" id="user_fname" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" name="user_lname" id="user_lname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">Select Category</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="select">Select Option</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" name="user_name" id="user_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" id="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_pass">Password</label>
        <input type="password" name="user_pass" id="user_pass" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Add User" class="btn btn-primary" name="create_user">
    </div>

</form>