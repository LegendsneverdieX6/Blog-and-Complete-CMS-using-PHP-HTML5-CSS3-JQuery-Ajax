<?php include("db.php"); ?>
<?php include('../functions.php') ?>
<?php session_start(); ?>

<?php
if(isset($_POST['login'])){
    $username = escape($_POST['username']);
    $userpass = escape($_POST['userpass']);
}

$username = mysqli_real_escape_string($connect, $username);
$userpass = mysqli_real_escape_string($connect, $userpass);

$query = "SELECT * FROM users WHERE user_name = '{$username}'";

$select_user_query = mysqli_query($connect, $query);

confirm($select_user_query);

while( $row = mysqli_fetch_array($select_user_query) ){

    $db_user_id = escape($row['user_id']);
    $db_user_name = escape($row['user_name']);
    $db_user_firstname = escape($row['user_firstname']);
    $db_user_lastname = escape($row['user_lastname']);
    $db_user_password = escape($row['user_pass']);
    $db_user_role = escape($row['user_role']);
}

//$userpass = crypt($userpass, $db_user_password);

if(password_verify($userpass, $db_user_password)){
    $_SESSION['username'] = $db_user_name;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;
    header("Location: ../admin");
} else{
    header("Location: ../index.php");
}
