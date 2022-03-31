<?php
include 'Session.php';
include('db_conn.php'); //db connection
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
$mysql = new Mysql();
if (isset($_POST)) {
    $input = $_POST;
    if ($input) {
        $data['username'] = $input['username'];
        $data['lastname'] = $input['surname'];
        $data['firstname'] = $input['famailyname'];
        $data['email'] = $input['email'];
        $data['mobile'] = $input['mobile'];
        $data['card'] = $input['card'];
        $data['sex'] = $input['sex'];
        $data['passwrod'] = md5($input['pwd1']);
        $data['permission'] = $input['permission'];
        if ($input['permission'] == "BM") {
            $data['discount'] = 20;
        } else if ($input['permission'] == "CM") {
            $data['discount'] = 85;
        } else if ($input['permission'] == "CS") {
            $data['discount'] = 90;
        } else if ($input['permission'] == "US") {
            $data['discount'] = 93;
        } else if ($input['permission'] == "DB") {
            $data['discount'] = 0;
        }else {
            $data['discount'] = 100;
        }
        $res_first = $mysql->query_first("select * from users where username = '" . $input['username'] . "'");
        if ($res_first) {
            exit("<script>alert('Username already exist.');history.go(-1);</script>");
        }
        $res_add = $mysql->query_insert('users', $data);
        if ($res_add) {
            echo("<script>alert('Register succeed');location.href = 'Login.php'</script>");
            die;
        } else {
            exit("<script>alert('Internet is unavailable, please try it later');history.go(-1);</script>");
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<head><title>Register</title></head>
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<?php require 'header.php' ?>
<div class="main">
    <FORM action="Register.php" method="post" onsubmit="return toValid();">
        <div class="box">
            <ul>
                <li>
                    <LABEL for="firstnamelabel">Surname name: </LABEL>
                    <INPUT type="text" required="required" name="surname" value=""
                           onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g,'')" id="fn"/>
                </li>
                <li>
                    <LABEL for="lastnamelabel">Famaily name : </LABEL>
                    <INPUT type="text" required="required" name="famailyname" value=""
                           onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g,'')" id="ln"/>
                </li>

                <li>
                    <LABEL for="emaillabel">E-mail :</LABEL>
                    <INPUT type="email" required="required" name="email" value="" id="email"/>
                </li>

                <li>
                    <LABEL for="idlabel">Mobile: </LABEL>
                    <INPUT type="text" required="required" name="mobile" value="" maxlength="10" minlength="10"
                           onkeyup="this.value=this.value.replace(/\D/g,'')" id="stuid"/>
                </li>
                <li>
                    <LABEL for="idlabel">CreditCard: </LABEL>
                    <INPUT type="text" required="required" name="card" value="" maxlength="16" minlength="16"
                           onkeyup="this.value=this.value.replace(/\D/g,'')" id="stuid"/>
                </li>
                <li>
                    <LABEL for="gender">Gender: </LABEL>
                    <INPUT type="radio" name="sex" checked value="Male"/> Male
                    <INPUT type="radio" name="sex" value="Female"/> Female
                </li>
                <li>
                    <LABEL for="pwd1">login user: </LABEL>
                    <INPUT type="text" required="required" value="" name="username" id="username"/>
                </li>
                <li>
                    <LABEL for="pwd1">Your Password: </LABEL>
                    <INPUT type="password" required="required" value="" name="pwd1" id="npwd1"/>
                </li>
                <li>
                    <LABEL for="pwd2">Confirm Password: </LABEL>
                    <INPUT type="password" required="required" value="" name="pwd2" id="npwd2"/>
                </li>
                <li>
                    <ul class="tips">
                        <li>1.Your password has to has:</li>
                        <li>2.6 to 12 characters in length</li>
                        <li>3.Contains at least 1 lower case letter</li>
                        <li>4.1 uppercase letter</li>
                        <li>5.1 number and one of the following special characters ~ ! # $</li>
                        <li>
                            6.Director of the Board(DBxxxx)/<br>
                            Utas Student(USxxxx)/<br>
                            Utas Employees(UExxxx)/<br>
                            Cafe Staff(CSxxx)/<br>
                            Cafe Manager(CMxxxx)/<br>
                            Board Members(BMxxx)<br>
                        </li>
                    </ul>
                </li>
                <li class="box">
                    <LABEL for="permission">You are:
                        <select name="permission" id="permission">
                            <option value="DB">Director of the Board</option>
                            <option value="US">Utas Student</option>
                            <option value="UE">Utas Employees</option>
                            <option value="CS">Cafe Staff</option>
                            <option value="CM">Cafe Manager</option>
                            <option value="BM">Board Members</option>
                        </select>
                    </LABEL>
                </li>
                <li class="box">
                    <INPUT class="basic-button" type="submit" value="Submit" id="doit"/>
                    <INPUT class="basic-button" type="reset" value="Reset"/>
                </li>
            </ul>
        </div>
    </FORM>
    <p>I have account, <a href="Login.php">Login</a> here!</p>
</div>
<script type="text/javascript">
    function toValid() {
        var surname = $('input[name=surname]').val();
        var famailyname = $('input[name=famailyname]').val();
        var email = $('input[name=email]').val();
        var mobile = $('input[name=mobile]').val();
        var card = $('input[name=card]').val();
        var permission = $('input[name=permission]').val();
        var pwd1 = $('input[name=pwd1]').val();
        var pwd2 = $('input[name=pwd2]').val();
        var sex = $('input[name=sex]:checked').val();

        //password's rules
        var pPattern = /^.*(?=.{6,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/;

        if (sex == "") {
            alert("Gender is required...");
            return false;
        }
        if (pwd1.length < 6 || pwd2.length < 6) {
            alert("Password is too short (less than 6 chars), please check");
            return false;
        }
        if (pwd1.length > 12 || pwd2.length > 12) {
            alert("Password is too long (more than 12 chars), please check");
            return false;
        }
        if (!pPattern.test(pwd1)) {
            alert("Your password does not match the rules");
            return false;
        }

        if (pwd1 != pwd1) {
            alert("Password doesn't match, please check");
            return false;
        }
        return true;
    }
</script>
</body>
</html>