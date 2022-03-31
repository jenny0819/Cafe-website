<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
if (!isset($_SESSION['username'])) {
    header('Location: Login.php');
}
$username = $_SESSION['username'];
$mysql = new Mysql();
$userfind  = $mysql->query_first("select * from users where username = '".$username."'");

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

if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $delete_res = $mysql->query_update("DELETE FROM staff_list WHERE id=" . $deleteid);
    if ($delete_res) {
        success_msg("Successfully deleted", 'admin.php');
    } else {
        return error_msg("Failed to delete");
    }
}

?>
<!DOCTYPE html>
<html>
<body>
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<script type="text/javascript">
    function dobalances() {
        var balance = $('input[name=balance]').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "user.php",
            data: {dobalance: 'dobalance', balance: balance},
            success: function (e) {
                if(e == 1){
                    alert("Top-up successful");
                    location.href="admin.php"
                } else{
                    alert(e.responseText);
                }
            },
            error: function (e) {
                if(e.responseText == 1){
                    alert(e.responseText);
                    location.href="user.php"
                } else{
                    alert(e.responseText);
                }
                return false;
            }
        });
    }
</script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<head><title>Admin</title></head>
<CENTER>
    <?php require 'header.php' ?>
    <div class="main" style="width: 1200px;">
        <table class="table border">
            <caption>Balance and Top up</caption>
            <tr>
                <td>Your username:</td>
                <td><?php echo $userfind['permission'].$userfind['username'] ?></td>
            </tr>
            <tr>
                <td>Your balance $</td>
                <td><?php echo $userfind['balance'] ?></td>
            </tr>
            <tr>
                <td>Top up amount</td>
                <td><input type="text" name="balance" /></td>
            </tr>
            <tr>
                <td class="box"><input class="basic-button" type="button" onclick="return dobalances();" name="alter" value="Top up"/></td>
            </tr>
        </table>
        <hr>
        <?php
        $lists  = $mysql->query_select("staff_list");
        $staff_list_find['id'] = '';
        $staff_list_find['name'] = '';
        $staff_list_find['position'] = '';
        $staff_list_find['branch'] = '';
        if (isset($_GET['updatestaffid'])) {
            $updatestaffid = $_GET['updatestaffid'];
            $staff_list_find = $mysql->query_first("select * from staff_list where id = '".$updatestaffid."'");
        }
        ?>
        <table class="table border" width="100%">
            <caption>Manage your Staff</caption>
            <tr>
                <th style="width: 20% !important;">ID</th>
                <th style="width: 20% !important;">Name</th>
                <th style="width: 20% !important;">Position</th>
                <th style="width: 20% !important;">Brunch</th>
                <th style="width: 20% !important;">operation</th>
            </tr>
            <?php
            foreach ($lists as $key => $val) {
                ?>
                <tr>
                    <th style="width: 20% !important;"><?php echo $val["id"]; ?></th>
                    <th style="width: 20% !important;"><?php echo $val["name"]; ?> </th>
                    <th style="width: 20% !important;"><?php echo $val["position"]; ?> </th>
                    <th style="width: 20% !important;"><?php echo $val["branch"]; ?></th>
                    <th style="width: 20% !important;"><a href="?deleteid=<?php echo $val["id"]; ?>" style="color: #333;">Delete</a>&nbsp;&nbsp;<a href="?updatestaffid=<?php echo $val["id"]; ?>" style="color: #333;">Choose</a></th>
                </tr>
            <?php
            }
            ?>
        </table>
        <hr>
        <input type="hidden" class="staff_input" value="<?php echo $staff_list_find['id'] ?>" name="staff_list_id">
        Name: <input type="text" class="staff_input" value="<?php echo $staff_list_find['name'] ?>" name="staff_name"><br>
        Position: <input type="text" class="staff_input" value="<?php echo $staff_list_find['position'] ?>" name="staff_position"><br>
        Branch: <input type="text" class="staff_input" value="<?php echo $staff_list_find['branch'] ?>" name="staff_branch"><br>
        <button class="border" type="button" onclick="return dostaffadd('add');" name="insertstaff">Insert</button>
        <button class="border" type="button" onclick="return dostaffadd('update');"  name="updatestaff">Update</button>
        <button class="border" type="button" onclick="return staffrefresh();" name="resetstaff">Reset</button>
        <script type="text/javascript">
            function staffrefresh() {
                $('.staff_input').val('');
            }
            function dostaffadd(insertstaff) {
                var staff_list_id = $('input[name=staff_list_id]').val();
                var staff_name = $('input[name=staff_name]').val();
                var staff_position = $('input[name=staff_position]').val();
                var staff_branch = $('input[name=staff_branch]').val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "addstaff.php",
                    data: {
                        insertstaff: insertstaff,
                        staff_list_id: staff_list_id,
                        staff_name: staff_name,
                        staff_position: staff_position,
                        staff_branch: staff_branch
                    },
                    success: function (e) {
                        if(e == 1){
                            if(insertstaff == 'add'){
                                alert("Added successfully");
                            } else {
                                alert("Successfully modified");
                            }
                            location.href="admin.php"
                        } else{
                            alert(e);
                        }
                    },
                    error: function (e) {
                        alert(e.responseText);
                        return false;
                    }
                });
            }
        </script>
        <hr>
        <?php
        if (isset($_GET['prodeleteid'])) {
            $deleteid = $_GET['prodeleteid'];
            $delete_res = $mysql->query_update("DELETE FROM kit202_product WHERE id=" . $deleteid);
            if ($delete_res) {
                success_msg("Successfully deleted", 'admin.php');
            } else {
                return error_msg("Failed to delete");
            }
        }
        ?>
        <?php
        $pro_lists  = $mysql->query_select("kit202_product");
        echo '<pre>';
        ?>
        <table class="table border" style="width: 100%;">
            <caption>Manage your Food</caption>
            <tr>
                <th style="width: 20%!important;">ID</th>
                <th style="width: 20%!important;">Name</th>
                <th style="width: 20%!important;">Price</th>
                <th  style="width: 20%!important;">Description</th>
                <th style="width: 20% !important;">operation</th>
            </tr>
            <?php
            foreach ($pro_lists as $key =>$val) {
            ?>
                <tr>
                    <th style="width: 20%!important;"><?php echo $val["id"]; ?></th>
                    <th style="width: 20%!important;"><?php echo $val["name"]; ?> </th>
                    <th style="width: 20%!important;"><?php echo $val["price"]; ?> </th>
                    <th style="width: 20%!important; text-align: left; padding: 0">
                        <textarea style="width: 100%; text-align: left; float: left; margin: 0; padding: 0; height: 80px;"><?php echo $val["description"]; ?></textarea>
                    </th>
                    <th style="width: 20% !important;"><a href="?prodeleteid=<?php echo $val["id"]; ?>" style="color: #333;">Delete</a>&nbsp;&nbsp;<a href="?proupdateid=<?php echo $val["id"]; ?>" style="color: #333;">Choose</a></th>
                </tr>
            <?php
            }
            ?>
        </table>
        <hr>
        <?php
        $goods_find['id'] = '';
        $goods_find['name'] = '';
        $goods_find['price'] = '';
        $goods_find['description'] = '';
        if (isset($_GET['proupdateid'])) {
            $proupdateid = $_GET['proupdateid'];
            $goods_find = $mysql->query_first("select * from kit202_product where id = '".$proupdateid."'");
        }
        ?>
        <input type="hidden" class="goods_input" value="<?php echo $goods_find['id'] ?>" name="goods_id">
        Name: <input type="text" class="goods_input"  value="<?php echo $goods_find['name'] ?>"  name="goods_name"><br>
        Price: <input type="text" class="goods_input"  value="<?php echo $goods_find['price'] ?>"  name="goods_price"><br>
        Description: <textarea name="goods_description"><?php echo $goods_find['description'] ?></textarea>
        <button type="submit" onclick="return dogoodsadd('add')" name="insert">Insert</button>
        <button type="submit" onclick="return dogoodsadd('update')"  name="update">Update</button>
        <button class="border" type="button" onclick="return goodsfresh();" name="reset">Reset</button>
    </div>
    <?php
    require_once("LoginStat.php");
    loggedIn();
    ?>
    <script type="text/javascript">
        function goodsfresh(){
            $('.goods_input').val('');
        }
        function dogoodsadd(insertstaff) {
            var goods_id = $('input[name=goods_id]').val();
            var goods_name = $('input[name=goods_name]').val();
            var goods_price = $('input[name=goods_price]').val();
            var goods_description = $('textarea[name=goods_description]').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "addgoods.php",
                data: {
                    insertstaff: insertstaff,
                    goods_id: goods_id,
                    goods_name: goods_name,
                    goods_price: goods_price,
                    goods_description: goods_description
                },
                success: function (e) {
                    if(e == 1){
                        if(insertstaff == 'add'){
                            alert("Added successfully");
                            location.href="admin.php"
                        } else {
                            alert("Successfully modified");
                            location.href="admin.php"
                        }
                    } else{
                        alert(e);
                        return false;
                    }
                },
                error: function (e) {
                    alert(e.responseText);
                    return false;
                }
            });
        }
    </script>
</body>
</html>
