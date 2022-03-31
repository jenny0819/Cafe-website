<?php

$host = '127.0.0.1';
$user = 'root';
$pass = 'root';
$dbname = 'ass';

$oot = 30; //order collection after opening
$oct = 60; //order collection before closing

$min_pwd_len = 6;
$max_pwd_len = 12;
$max_name_len = 32;
$mobile_length = 10;
$card_length = 16;

$Director_discount = 1;
$CampusManager_discount = 0.8;
$CafeManager_discount = 0.15;
$UTASSTU_discount = 0.07;
$UTASSTA_discount = 0;

$mysqli = new mysqli($host, $user, $pass, $dbname);

//$con = mysql_connect($host,$user,$pass);
//if (!$con) {
//	die('couldnt connect: ' . mysql_error());
//}
//mysql_select_db($dbname, $con);

$today = date("Y-m-d");
//$Tsql = $mysqli->query("SELECT * FROM operation");
//$Trow = mysqli_fetch_array($Tsql);
//$OH = $Trow["openH"]; // opentime
//$OM = $Trow["openM"];
//$CH = $Trow["closeH"]; // close time
//$CM = $Trow["closeM"];
//
//$cafe_open_time = (strtotime($today)) + $OH * 3600 + $OM * 60; // cafe open time
//$cafe_close_time = (strtotime($today)) + $CH * 3600 + $CM * 60; // cafe close time
//
//$order_open_time = (strtotime($today)) + $OH * 3600 + $OM * 60 + $oot * 60; // time to start collecting orders
//$order_close_time = (strtotime($today)) + $CH * 3600 + $CM * 60 + $oct * 60; // deadline to collect orders

function error_msg($_msg)
{
    echo("<script>alert('" . $_msg . "');history.go(-1);</script>");
    return true;
}

function success_msg($_msg, $url = '')
{
    echo("<script>alert('" . $_msg . "');location.href = '" . $url . "'</script>");
    die;
}

?>