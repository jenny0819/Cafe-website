<?php
//print ( "Welcome, user ".$_POST["id"]." You have Logged in..." );
//print ( "sex : ".$_POST["sex"]."<br>" );
include 'Session.php';
include('db_conn.php'); //db connection
$mysql = new Mysql();
include 'inc.php';
$username = $_POST["username"];
$encrypt_pwd = md5($_POST["pwd"]);
if (empty($username)) return error_msg("Please input username");
if (empty($encrypt_pwd)) return error_msg("Please input passwrod");
$res_first = $mysql->query_first("select * from users where username = '" . $username . "'");
if (empty($res_first)) return error_msg("Username is incorrect");
if ($res_first['passwrod'] != $encrypt_pwd) return error_msg("Passwrod is incorrect");
$_SESSION['username'] = $username;
$_SESSION['user_id'] = $res_first['id'];
$_SESSION['permission'] = $res_first['permission'];
$_SESSION['sex'] = $res_first['sex'];
if ($res_first['permission'] == "DB"|| $res_first['permission'] == "BM") {
    //DB，BM
    success_msg("Login successful", 'admin.php');
} elseif ($res_first['permission'] == "CM" || $res_first['permission'] == "CS") {
    //CM，CS
    success_msg("Login successful", 'manager.php');
} else {
    //CC
    success_msg("Login successful", 'user.php');
}
?>