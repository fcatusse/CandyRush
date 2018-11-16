<?php
include_once "connect_db.php";
include_once "config.php";
include_once "product_admin.php";


	$product = new ProductAdmin();
	$array = $product->displayProduct($_GET["product_id"], "name", "price", "category_id");
	//echo ($array["name"]);
	$name = $array["name"];
	$price = $array["price"];
	$category_id = $array["category_id"];
	$category = $product->getCategoryReverse($category_id);
?>

<?php include_once "header.php" ; ?>
	<?php echo $name ;?><br>
	<?php echo $price ;?> euros <br>
	<?php echo $category ;?><br>
<?php include_once "footer.php" ; ?>
