<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
$mysql = new Mysql();
$username = $_SESSION['username'];
$userfind = $mysql->query_first("select * from users where username = '" . $username . "'");

if (isset($_POST['goodsid'])) {
    $goodsid = $_POST['goodsid'];
    $num = $_POST['num'];
    $description = $_POST['description'];
    $pickuptime = $_POST['pickuptime'];
    $price = $_POST['price'];
    $total_price = 0;
    $total_price_bu = 0;
    $buynum = 0;
    foreach ($goodsid as $key => $val) {
        if ($num[$key] > 0) {
            $buynum = 1;
            $total_price_bu += $price[$key] * $num[$key];
        }
    }
    if ($total_price_bu > $userfind['balance']) {
        echo("<script>alert('Please recharge');location.href = 'Menu.php'</script>");
        die;
    }
    if ($buynum <= 0) {
        echo("<script>alert('Please choose product');location.href = 'Menu.php'</script>");
        die;
    }
    foreach ($goodsid as $key => $val) {
        if ($num[$key] > 0) {
            $buynum = 1;
            $goods = $mysql->query_first("select * from kit202_product where id = '" . $val . "'");
            $_t['username'] = $username;
            $_t['order_sn'] = date('Ymdhis') . mt_rand(9999, 99999);
            $_t['price'] = $price[$key] * $num[$key];
            $total_price += $price[$key] * $num[$key];
            $_t['inputtime'] = time();
            $_t['pickuptime'] = $pickuptime;
            $_t['description'] = $description[$key];
            $_t['goods_name'] = $goods['name'];
            $_t['goods_id'] = $val;
            $mysql->query_insert('orders', $_t);
        }
    }
    $balance = $userfind['balance'] - $total_price * ($userfind['discount'] / 100);
    $res = $mysql->query_update('update users set balance = "' . $balance . '" where username = "' . $username . '"');
    echo("<script>alert('Order successful');location.href = 'Menu.php'</script>");
    die;
}


?>
