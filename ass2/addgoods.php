<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
$mysql = new Mysql();
if (isset($_POST['insertstaff'])) {
    if ($_POST['insertstaff'] == 'update') {
        $input = $_POST;
        $data['name'] = $input['goods_name'];
        $data['price'] = $input['goods_price'];
        $data['description'] = $input['goods_description'];
        $data['images'] = "./pic/cafe-latte.jpg";
        if (empty($input['goods_id'])) exit("Please input ID");
        if (empty($input['goods_name'])) exit("Please input Name");
        if (empty($input['goods_price'])) exit("Please input Price");
        if (empty($input['goods_description'])) exit("Please input Description");
        $res = $mysql->query_update('update kit202_product set name = "' . $input['goods_name'] . '", price = "' . $input['goods_price'] . '", description = "' . $input['goods_description'] . '" where id = "' . $input['goods_id'] . '"');
        if ($res) {
            exit("1");
        } else {
            exit("Internet is unavailable, please try it later");
        }
    } else {
        $input = $_POST;
        $data['name'] = $input['goods_name'];
        $data['price'] = $input['goods_price'];
        $data['description'] = $input['goods_description'];
        if (empty($input['goods_name'])) exit("Please input Name");
        if (empty($input['goods_price'])) exit("Please input Price");
        if (empty($input['goods_description'])) exit("Please input Description");
        $res_add = $mysql->query_insert('kit202_product', $data);
        if ($res_add) {
            exit("1");
        } else {
            exit("The adding is fail");
        }
    }
}
?>
