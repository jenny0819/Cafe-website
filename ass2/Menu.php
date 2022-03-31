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
<head><title>Menu</title></head>
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<CENTER>
    <?php require 'header.php'?>
    <div class="main">
        <table class="table">
            <img src="./pic/time.jpg" alt="time" width="150"/>
            <h4> we are open 7 days a week</h4>
            <h4>Opennig time</h4>
            <?php
            $storedatelists = $mysql->query_select("store_date");
            foreach($storedatelists as $key => $val){
            ?>
            <tr class="coffee border">
                <th><?php echo $val['week_name']; ?></th>
                <th><?php echo $val['open_time']; ?>-<?php echo $val['close_time']; ?></th>
            </tr>
            <?php } ?>
        </table>
        <h1>Chooese your drinks</h1>
        <form action="doorder.php" method="post">
            <table class="table">
                <?php
                $goodlist = $mysql->query_select("kit202_product");
                foreach($goodlist as $key => $val){
                    ?>
                    <tr class="coffee">
                        <th><img src="<?php echo  $val['images']?>" alt="latte" width="150"/></th>
                        <th><?php echo  $val['description']?></th>
                        <th>
                            <input type="hidden" name="goodsid[]" value="<?php echo  $val['id']?>"/>
                            <ul class="count">
                                <li><span id="num-jian" class="num-jian" onclick="return jiannum(<?php echo  $val['id']?>);">-</span></li>
                                <li>
                                    <input type="text" name="num[]" class="input-num input-num-<?php echo  $val['id']?>" id="input-num" value="0"/>
                                    <input type="hidden" name="price[]" class="inputprice" value="<?php echo  $val['price']?>"/>
                                </li>
                                <li><span id="num-jia" class="num-jia" onclick="return addnum(<?php echo  $val['id']?>);">+</span></li>
                            </ul>
                        </th>
                        <th>Price<p>$<?php echo  $val['price']?></p></th>
                        <th>Description:<input type="text" name="description[]" id="description"/></th>
                    </tr>
                <?php } ?>
            </table>
            <script type="text/javascript">
                function jiannum(id) {
                    var num = $('.input-num-' + id).val();
                    if (num > 0) {
                        $('.input-num-' + id).val(parseInt(num) - 1);
                        totalpice();
                    }

                }
                function addnum(id) {
                    var num = $('.input-num-' + id).val();
                    $('.input-num-' + id).val(parseInt(num) + 1);
                    totalpice();
                }
                function totalpice() {
                    var numsize = $('.input-num').size();
                    var total_price = 0;
                    for (var i = 0; i < numsize; i++) {
                        var num = $('.input-num').eq(i).val();
                        var inputprice = $('.inputprice').eq(i).val();
                        total_price = parseInt(total_price) + parseInt(num) * parseFloat(inputprice);

                    }
                    var discount = "<?php echo $userfind['discount'];?>";
                    $('.total_price_val').html((total_price * discount / 100).toFixed(2));
                    $('.total_price_val').val((total_price * discount / 100).toFixed(2));
                }
            </script>
            <input type="hidden" class="total_price_val" value="0"/>
            <p>You only need to pay <b><?php echo $userfind['discount'];?>%</b> of your order.</p>
            <p>Total:$<b class="total_price_val">0</b></p>
            <p>Your balance:$<b><?php echo $userfind['balance'];?></b></p>
            <p>Pick up time:
                <select name="pickuptime">
                    <option value="730">7:30</option>
                    <option value="745">7:45</option>
                    <option value="800">8:00</option>
                    <option value="815">8:15</option>
                    <option value="830">8:30</option>
                    <option value="845">8:45</option>
                    <option value="900">9:00</option>
                    <option value="915">9:15</option>
                    <option value="930">9:30</option>
                    <option value="945">9:45</option>
                    <option value="1000">10:00</option>
                    <option value="1015">10:15</option>
                    <option value="1030">10:30</option>
                    <option value="1045">10:45</option>
                    <option value="1100">11:00</option>
                    <option value="1115">11:15</option>
                    <option value="1130">11:30</option>
                    <option value="1145">11:45</option>
                    <option value="1200">12:00</option>
                </select>
            </p>
            <button class="basic-button" type="submit" name="submit">Order</button>
        </form>
    </div>
    <?php
    require_once("LoginStat.php");
    loggedIn();
    ?>
</body>
</html>