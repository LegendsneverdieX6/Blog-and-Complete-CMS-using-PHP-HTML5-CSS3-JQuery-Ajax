<?php
/**
 * Created by PhpStorm.
 * User: Tamal
 * Date: 12/6/15
 * Time: 11:48 PM
 */

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "mysql";
$db['db_name'] = "cms_mac";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}


$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connect){
    //echo 'Database Coneected!';
}