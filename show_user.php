<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";

if ($_SESSION["is_admin"] == 1 ) {

	$user = new UserAdmin();
	$array = $user->displayUser($_SESSION["user_id"], "username", "email", "admin");
	//echo ($array["name"]);
	$username = $array["username"];
	$email = $array["email"];
	$admin  = $array["admin"];
	if ($admin == 1) {
		$is_admin = "Administrator";
	} else {
		$is_admin = "Regular user";
	}

} else {
	header("Location: index.php");
	exit;
}


?>

<?php include_once "header.php" ; ?>
	<?php echo $username ;?><br>
	<?php echo $email ;?> <br>
	<?php echo $is_admin ;?><br>
<?php include_once "footer.php" ; ?>
