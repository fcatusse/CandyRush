<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
session_start();

$link = "";

if($_SESSION["name"])
{
    echo "Hello " .$_SESSION["name"]. "<br>";
}
else
{
    Header("Location: login.php");
}

if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1) {
	$link = '<a href="admin.php"> Admin dashboard </a><br>';
}

?>
<!DOCTYPE html>
<html>
	<?php echo $link; ?>
	<p><a href="edit_self.php"> Settings </a></p>
	<p><a href="logout.php"> Logout </a></p>
</html>

