<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";
include_once "product_admin.php";
session_start();

$link = "";

if ($_SESSION["is_admin"] == 1) {
	$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
	$admin = new UserAdmin();
	$adminprod = new ProductAdmin();

	if (isset($_GET["delete"])) {
		if ($_GET["admin"] != 1) {
			$id = $_GET["delete"];
			$admin->deleteUser($id);
		} else {
			echo "You can’t delete an administrator.<br>";
		}
	} 

	if (isset($_GET["edit"])) {
		if ($_GET["admin"] != 1) {
			$id = $_GET["edit"];
			$_SESSION["user_id"] = $id;
			header("Location: edit_user.php");
			exit();
		} else {
			echo "You can’t edit an administrator.<br>";
		}
	} 

	if (isset($_GET["deleteprod"])) {
		$id = $_GET["deleteprod"];
		$adminprod->deleteProduct($id);
	} 

	if (isset($_GET["editprod"])) {
		$id = $_GET["editprod"];
		$_SESSION["product_id"] = $id;
		header("Location: edit_product.php");
		exit();
	} 

	$query = 'SELECT * FROM users';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$link .= '<li> '.$d->email.' <a href="admin.php?delete='.$d->id.'&admin='.$d->is_admin.'"> Delete </a> 
	 					<a href="admin.php?edit='.$d->id.'&admin='.$d->is_admin.'"> Edit </a></li>';
	}

	$query = 'SELECT * FROM products';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$link .= '<li> '.$d->name.' <a href="admin.php?deleteprod='.$d->id.'"> Delete </a>  <a href="admin.php?editprod='.$d->id.'"> Edit </a></li>';
	}

	 
} else {
	header("Location: index.php");
	exit();	
}

?>

<!DOCTYPE html>
<html>
	<ul>
		<?php echo $link; ?>
		<a href="signup.php"> Add user </a>
		<a href="signup_product.php"> Add product </a>
	</ul>
</html>
