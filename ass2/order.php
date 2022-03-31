<?php
include 'Session.php';
include('db_conn.php'); //db connection
$mysql = new Mysql();
include 'inc.php';
$username = $_SESSION['username'];
$mysql = new Mysql();
$userfind = $mysql->query_first("select * from users where username = '" . $username . "'");

?>

<!DOCTYPE html>
<html>
    <body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<head><title>Order Management</title></head>
<?php require 'header.php'?>
        <div class="main">
            <?php
            $orderlist = $mysql->query_select_order("orders");
            ?>
            <table class="table border">
                <caption>Today's Order</caption>
                <tr>
                    <th>OrderID</th>
                    <th>UserName</th>
                    <th>Order</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                <?php
                foreach ($orderlist as $var) {
                    ?>
                    <tr>
                        <th><?php echo $var["orderid"]; ?></th>
                        <th><?php echo $var["username"]; ?> </th>
                        <th><?php echo $var["order_sn"]; ?> </th>
                        <th><?php echo $var["price"]; ?> </th>
                        <th><?php echo $var["description"]; ?></th>
                        <th><?php echo $var["pickuptime"]; ?></th>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <button class="button" onClick = "document.location.reload()">Refresh</button>
        </div>
    </body>
</html>