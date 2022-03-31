<?php
include 'Session.php';
include('db_conn.php'); //db connection
include 'inc.php';
if (!isset($_SESSION['username'])) {
    header('Location: Login.php');
}
$username = $_SESSION['username'];
$mysql = new Mysql();
$userfind = $mysql->query_first("select * from users where username = '" . $username . "'");

?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<head><title>Manager Account</title></head>
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
                if (e == 1) {
                    alert("Top-up successful");
                    location.href = "manager.php"
                } else {
                    alert(e.responseText);
                }
            },
            error: function (e) {
                if (e.responseText == 1) {
                    alert(e.responseText);
                    location.href = "user.php"
                } else {
                    alert(e.responseText);
                }
                return false;
            }
        });
    }
</script>
<CENTER>
    <?php require 'header.php' ?>
    <div class="main" style="width: 1200px;">
        <table class="table border">
            <caption>Balance and Top up</caption>
            <tr>
                <td>Your username:</td>
                <td><?php echo $userfind['username'] ?></td>
            </tr>
            <tr>
                <td>Your balance $</td>
                <td><?php echo $userfind['balance'] ?></td>
            </tr>
            <tr>
                <td>Top up amount</td>
                <td><input type="text" name="balance"/></td>
            </tr>
            <tr>
                <td class="box"><input class="basic-button" type="button" onclick="return dobalances();" name="alter"
                                       value="Top up"/></td>
            </tr>
        </table>
        <hr>
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
                                location.href="manager.php"
                            } else {
                                alert("Successfully modified");
                                location.href="manager.php"
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
        <hr>
       <form action="domanager.php" method="post">
           <table width="100%" class="border">
               <h4>Manager The Opennig time</h4>
               <tr>
                   <th>Day</th>
                   <th>Open time</th>
                   <th>Close time</th>
               </tr>
               <?php
               $storedatelists = $mysql->query_select("store_date");
               foreach($storedatelists as $key => $val){
                   ?>
                   <tr>
                       <th>
                           <input type="hidden" name="week_id[]" value="<?php echo $val['id']; ?>"/>
                           <input type="hidden" name="week_name[]" value="<?php echo $val['week_name']; ?>"/>
                           <?php echo $val['week_name']; ?>
                       </th>
                       <th>
                           <select name="open_time[]">
                               <option <?php echo $val['open_time'] == "7:00AM" ? 'selected':''; ?> value="7:00AM">7:00AM</option>
                               <option <?php echo $val['open_time'] == "8:00AM" ? 'selected':''; ?>  value="8:00AM">8:00AM</option>
                               <option <?php echo $val['open_time'] == "9:00AM" ? 'selected':''; ?>  value="9:00AM">9:00AM</option>
                               <option <?php echo $val['open_time'] == "10:00AM" ? 'selected':''; ?> value="10:00AM">10:00AM</option>
                               <option <?php echo $val['open_time'] == "11:00AM" ? 'selected':''; ?> value="11:00AM">11:00AM</option>
                           </select>
                       </th>
                       <th>
                           <select name="close_time[]">
                               <option <?php echo $val['close_time'] == "12:00PM" ? 'selected':''; ?> value="12:00PM">12:00PM</option>
                               <option <?php echo $val['close_time'] == "1:00PM" ? 'selected':''; ?> value="1:00PM">1:00PM</option>
                               <option <?php echo $val['close_time'] == "2:00PM" ? 'selected':''; ?> value="2:00PM">2:00PM</option>
                               <option <?php echo $val['close_time'] == "3:00PM" ? 'selected':''; ?> value="3:00PM">3:00PM</option>
                               <option <?php echo $val['close_time'] == "4:00PM" ? 'selected':''; ?> value="4:00PM">4:00PM</option>
                               <option <?php echo $val['close_time'] == "5:00PM" ? 'selected':''; ?> value="5:00PM">5:00PM</option>
                               <option <?php echo $val['close_time'] == "6:00PM" ? 'selected':''; ?> value="6:00PM">6:00PM</option>
                               <option <?php echo $val['close_time'] == "7:00PM" ? 'selected':''; ?> value="7:00PM">7:00PM</option>
                           </select>
                       </th>
                   </tr>
               <?php } ?>
           </table>
           <button type="submit" name="updatetime">Update time</button>
       </form>
    </div>
    <?php
    require_once("LoginStat.php");
    loggedIn();
    ?>
</body>
</html>
