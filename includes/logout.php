<?php session_start(); ?>

<?php
    $_SESSION['username'] = $db_user_name;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;
    header("Location: ../admin");

    header("Location: ../index.php");
