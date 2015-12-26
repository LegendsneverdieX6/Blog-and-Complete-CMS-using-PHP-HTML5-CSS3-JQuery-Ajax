<?php
function confirm($result){
    global $connect;
    if(!$result){
        die('QUERY FAILED' . mysqli_error($connect));
    }

}

function escape($string){
    global $connect;
    return mysqli_real_escape_string($connect, trim(strip_tags($string)));
}
