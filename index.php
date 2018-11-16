<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
session_start();

$link = "cool";
$cat_list = NULL;

if($_SESSION["name"])
{
    echo "Hello " .$_SESSION["name"]. "<br>";
}
else
{
    Header("Location: login.php");
}

if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1) {
	$link = '<p><a href="admin.php"> Admin dashboard </a><br></p>';
}

if (isset($_GET["viewprod"])) {
	$id = $_GET["viewprod"];
	$_SESSION["category_id"] = $id;
	header("Location: show_category_content.php");
	exit();
} 

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$query = 'SELECT * FROM categories WHERE parent_id=0';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$cat_list .= '<p><li> '.$d->name.' <a href="index.php?viewprod='.$d->id.'"> View </a></p>';
	}



?>
<!DOCTYPE html>
<html>
	<?php
	echo $link;  
	echo $cat_list; 
	?>
	<p><a href="edit_self.php"> Settings </a></p>
	<p><a href="logout.php"> Logout </a></p>
</html>