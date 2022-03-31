<?php
include 'session.php';
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<head><title>Login</title></head>
<?php require 'header.php'?>
<div class="main">
    <FORM action="user_login.php" method="post">
        <div class="box">
            <LABEL for="idlabel">username: </LABEL>
            <INPUT type="text" required="required" name="username" id="stuid"/>
        </div>
        <div class="box">
            <LABEL for="pwd1">password: </LABEL>
            <INPUT type="password" required="required" name="pwd" id="pwd"/>
        </div>
        <div class="box">
            <INPUT class="basic-button" type="submit" name="login" value="Login"/>
            <INPUT class="basic-button" type="reset" value="Reset"/>
        </div>
    </FORM>
</div>
<?php
if (!isset($_SESSION['id'])) {
    echo '<p1>Need an account? <a href="Register.php">Register</a> here</p1><br><p2>This is our<a href="Menu.php">Cafe Menu</a></p2>';
} else {
    echo '<p2>Link to <a href="Menu.php">Cafe Menu</a></p2>';
}
?>	
</div>
</body>
</html>
