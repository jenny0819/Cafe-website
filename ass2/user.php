<?php
include 'db_conn.php';
include 'session.php';
include 'inc.php';
if (!isset($_SESSION['username'])) {
    header('Location: Login.php');
}
$username = $_SESSION['username'];
$mysql = new Mysql();
$userfind = $mysql->query_first("select * from users where username = '" . $username . "'");

if (isset($_POST['upuserdata'])) {
    $input = $_POST;
    $data['lastname'] = $input['lastname'];
    $data['firstname'] = $input['firstname'];
    $data['email'] = $input['email'];
    $data['mobile'] = $input['mobile'];
    $data['card'] = $input['card'];
    if ($input['passwrod']) {
        $data['passwrod'] = md5($input['passwrod']);
    }
    $res = $mysql->query_update('update users set lastname = "' . $input['lastname'] . '", firstname = "' . $input['firstname'] . '", email = "' . $input['email'] . '", mobile = "' . $input['mobile'] . '", card = "' . $input['card'] . '", passwrod = "' . $input['passwrod'] . '" where username = "' . $username . '"');
    if ($res) {
        echo("<script>alert('Successfully modified');location.href = 'user.php'</script>");
        die;
    } else {
        exit("<script>alert('Internet is unavailable, please try it later');history.go(-1);</script>");
    }
}

if (isset($_POST['dobalance'])) {
    $input = $_POST;
    if (empty($input['balance'])) exit("Please enter the top-up amount");
    $money_reg = '/^[1-9]\d*|^[1-9]\d*.\d+[1-9]$/';
    if (!preg_match($money_reg, $input['balance'])) exit("The top-up amount is incorrect");
    $balance = $userfind['balance'] + $input['balance'];
    $res = $mysql->query_update('update users set balance = "' . $balance . '" where username = "' . $username . '"');
    if ($res) {
        exit("1");
    } else {
        exit("Internet is unavailable, please try it later");
    }
}

?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<head><title>User Account</title></head>
<?php require 'header.php' ?>
<div class="main">
    <form action="" method="post">
        <table id="form">
            <caption>Account Inforamtion</caption>
            <tr>
                <td>username:</td>
                <td><?php echo $userfind["username"]; ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="firstname" required="required"
                           value="<?php echo $userfind['firstname']; ?>"/></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lastname" required="required"
                           value="<?php echo $userfind['lastname']; ?>"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required="required" value="<?php echo $userfind['email']; ?>"/></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><input type="text" name="mobile" required="required" value="<?php echo $userfind['mobile']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Credit Card</td>
                <td><input type="text" name="card" required="required" value="<?php echo $userfind['card']; ?>"/></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td><input type="text" name="passwrod"/></td>
            </tr>
            <tr>
                <td class="box" colspan="2" id="submit"><input class="basic-button" type="submit" name="upuserdata"
                                                               value="update"/></td>
            </tr>
        </table>
        <form>
            <div>
                <form action="" method="post">
                    <table class="table border">
                        <caption>Balance and Top up</caption>
                        <tr>
                            <td>Your balance $</td>
                            <td><?php echo $userfind['balance']; ?></td>
                        </tr>
                        <tr>
                            <td>Top up amount</td>
                            <td><input type="text" name="balance"/></td>
                        </tr>
                        <tr>
                            <td class="box"><input class="basic-button" type="button" onclick="return dobalances();"
                                                   name="dobalance" value="Top up"/></td>
                        </tr>
                    </table>
                </form>
            </div>
</div>
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
                    location.href = "user.php"
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
<?php
require_once("LoginStat.php");
loggedIn();
?>
</body>
</html>
