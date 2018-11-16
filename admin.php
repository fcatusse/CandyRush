<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";
include_once "product_admin.php";

$link = "";
$link2 = "";
$alert = "<br>";

if ($_SESSION["is_admin"] == 1) {
	$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
	$admin = new UserAdmin();
	$adminprod = new ProductAdmin();

	if (isset($_GET["delete"])) {
		if ($_GET["admin"] != 1) {
			$id = $_GET["delete"];
			$alert = $admin->deleteUser($id);
		} else {
			$alert = "You can’t delete an administrator.<br>";
		}
	} 

	if (isset($_GET["edit"])) {
		if ($_GET["admin"] != 1) {
			$id = $_GET["edit"];
			$_SESSION["user_id"] = $id;
			header("Location: edit_user.php");
			exit();
		} else {
			$alert = "You can’t edit an administrator.<br>";
		}
	} 


	if (isset($_GET["showuser"])) {
		$id = $_GET["showuser"];
		$_SESSION["user_id"] = $id;
		header("Location: show_user.php");
		exit();
	} 

	if (isset($_GET["deleteprod"])) {
		$id = $_GET["deleteprod"];
		$alert = $adminprod->deleteProduct($id);
	} 

	if (isset($_GET["editprod"])) {
		$id = $_GET["editprod"];
		$_SESSION["product_id"] = $id;
		header("Location: edit_product.php");
		exit();
	} 

	if (isset($_GET["showprod"])) {
		$id = $_GET["showprod"];
		$_SESSION["product_id"] = $id;
		header("Location: show_product.php");
		exit();
	} 

	$query = 'SELECT * FROM users';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$link .= '<li class="collection-item"> '.$d->email.' 
	 	<span style="float:right;"> <a href="admin.php?delete='.$d->id.'&admin='.$d->admin.'" onclick="return confirm(\'Are you sure you want to delete this item?\');"> Delete -</a> <a href="admin.php?edit='.$d->id.'&admin='.$d->admin.'"> Edit - </a>
	 	<a href="admin.php?showuser='.$d->id.'"> Show  </a> </span></li>';
	}

	$query = 'SELECT * FROM products';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$link2 .= '<li class="collection-item"> '.$d->name.' 
	 	<span style="float:right;"> <a href="admin.php?deleteprod='.$d->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\');"> Delete -</a>  <a href="admin.php?editprod='.$d->id.'"> Edit -</a>
	 	<a href="show_product.php?product_id='.$d->id.'"> Show </a> 
	 	</span></li>';
	}

	 
} else {
	header("Location: index.php");
	exit();	
}

?>
<?php include_once "header.php" ?>

<div class = "container">
<p> <?php echo $alert;?></p>
<h3> Admin dashboard</h3>
<h5>Users</h5>
<ul class="collection">
     <?php echo $link; ?>
</ul>
<h5>Products</h5>
<ul class="collection">
     <?php echo $link2; ?>
</ul>
<ul>
<li><h6><a href="signup.php"> Add user </a></h6></li>
<li><h6><a href="signup_product.php"> Add product </a></h6></li>
<li><h6><a href="create_categories.php"> Create Category </a></h6></li>
</ul>

</div>

<?php include_once "footer.php" ?>
