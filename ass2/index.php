<?php
include 'Session.php';
include('db_conn.php'); //db connection
?>

<!DOCTYPE html>

<html>
<body>
<link rel="stylesheet" type="text/css" href="main.css">
<head><title>welcome</title></head>

<CENTER>
   <?php require 'header.php'?>
    
    <div class="main">
        
        <div>
            <h3>Who we are?</h3>
            <p>
                Y.E.O.M. Pty. Ltd. has bought out Lazenbys, The Ref and The Trade Table at University of Tasmania
(UTas). In discussion with the staff and students at UTas, it was discovered that the biggest
complaint was having to wait in long queues during peak times when they have just a short time to
get a meal or beverage.
To address this issue, it has been decided to develop a web site where food and drink can be preordered and pre-paid so that clients can quickly collect their meals.
            </p>
            <div class="logo">
                <img src="./pic/ttt.jpg" width="250" height="200" alt="logo" />
            </div>
        </div>
        
        
    </div>
<?php
require_once("LoginStat.php");
    loggedIn();
?>

</body>
</html>
