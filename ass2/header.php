<?php
$isshoworder = 0;
$isshowaccount = 0;
$isshowadmin = 0;
$isshowmanager = 0;
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
$permission = isset($_SESSION["permission"]) ? $_SESSION["permission"] : 0;
if ($permission) {
    if ($permission == 'DB'|| $permission == "BM") {
        $isshowadmin = 1;
    }
    if ($permission == 'CM'|| $permission == "CS") {
        $isshowmanager = 1;
    }
}
?>
<header>
    <h1>Welcome to Y.E.O.M Pty Ltd, enjoy your day~</h1>
    <ul class="list">
        <li><a href="index.php">Home</a></li>
        <?php if(empty($permission)){ ?>
            <li><a href="Login.php">Login</a></li>
        <?php }?>
        <?php if($username){ ?>
            <li><a href="Menu.php">Menu</a></li>
        <?php }?>
        <?php if(empty($permission)){ ?>
            <li><a href="Register.php">Register</a></li>
        <?php }?>
        <li><a href="user.php">My Account</a></li>
        <?php if($isshowmanager == 1){ ?>
        <li><a href="manager.php">Manager</a></li>
        <li><a href="order.php">Order Management</a></li>
        <?php }?>
        <?php if($isshowadmin == 1){ ?>    
            <li><a href="admin.php">Admin</a></li>
        <?php }?>
    </ul>
</header>