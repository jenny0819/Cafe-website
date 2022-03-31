<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<?php
function loggedIn()
{
    if (!isset($_SESSION['username'])) {

    } else {
        echo 'User: ' . $_SESSION['username'] . ' ';
        echo "<a href='Logout.php'><input class=\"basic-button\" type=\"button\" value=\"Log out\"></a>";
    }
}

?>
</html>
</body>