<?php 
session_start();
session_destroy();
include 'inc.php';
success_msg("Logout successful",'Login.php');
?>