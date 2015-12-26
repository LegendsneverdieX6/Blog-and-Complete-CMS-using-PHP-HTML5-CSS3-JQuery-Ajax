<?php
/**
 * Created by PhpStorm.
 * User: Tamal
 * Date: 12/13/15
 * Time: 11:24 AM
 */
function escape($string){
    global $connect;
    return mysqli_real_escape_string($connect, trim(strip_tags($string)));
}

function confirm($result){
    global $connect;
    if(!$result){
        die('QUERY FAILED' . mysqli_error($connect));
    }

}


function users_online(){

    if(isset($_GET['onlineusers'])){


    global $connect;
    if(!$connect){
        session_start();
        include("../includes/db.php");

        $session = session_id();

        $time = time();

        $time_out_in_seconds = 60;

        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";

        $send_query = mysqli_query($connect, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL){
                mysqli_query($connect, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            }else{
                mysqli_query($connect, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

        $user_online_query = mysqli_query($connect, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($user_online_query);
    }

    }


}
users_online();


function insert_categories(){
    global $connect;
    if(isset($_POST['submit'])){
        $cat_title= $_POST['cat_title'];
        if($cat_title =='' || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            $query = "INSERT INTO category(cat_title) ";
            $query .= "VALUE('{$cat_title}')";
            $create_cat_query = mysqli_query($connect, $query);
            if(!$create_cat_query){
                die('QUERY FAILED' . mysqli_error($connect));
            }

        }
    }
}

function findAllCategories(){
    global $connect;
    $query = "SELECT * FROM category";
    $cat_query = mysqli_query($connect, $query);
    while( $row = mysqli_fetch_assoc($cat_query)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td></tr>";
    }
}

function delete_categories(){
    global $connect;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connect, $query);
        header("Location: categories.php");

    }
}