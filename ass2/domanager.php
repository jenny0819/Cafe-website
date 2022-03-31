<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
$mysql = new Mysql();
$username = $_SESSION['username'];
if (isset($_POST['dobalance'])) {
    $input = $_POST;
    if (empty($input['balance'])) exit("Please enter the top-up money") ;
    $money_reg = '/^[1-9]\d*|^[1-9]\d*.\d+[1-9]$/';
    if (!preg_match($money_reg, $input['balance'])) exit("The top-up money is incorrect") ;
    $balance = $userfind['balance'] + $input['balance'];
    $res = $mysql->query_update('update users set balance = "' . $balance . '" where username = "' . $username . '"');
    if ($res) {
        exit("1");
    } else {
        exit("Internet is unavailable, please try it later");
    }
}

if(isset($_POST['week_name'])){
    $open_time = $_POST['open_time'];
    $close_time = $_POST['close_time'];
    foreach($_POST['week_id'] as $key => $val){
        $mysql->query_update('update store_date set open_time = "' . $open_time[$key] . '", close_time = "' . $close_time[$key] . '" where id = "' . $val . '"');
    }
    success_msg("Successfully modified", 'manager.php');
}

?>
