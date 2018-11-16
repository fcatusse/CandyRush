<?php
include_once "connect_db.php";
include_once "config.php";
include_once "product_admin.php";
session_start();

	$product = new ProductAdmin();
	$array = $product->displayProduct($_GET["product_id"], "name", "price", "category_id");
	//echo ($array["name"]);
	$name = $array["name"];
	$price = $array["price"];
	$category_id = $array["category_id"];
	$category = $product->getCategoryReverse($category_id);
?>

<!DOCTYPE html>
<html>
	<?php echo $name ;?><br>
	<?php echo $price ;?> euros <br>
	<?php echo $category ;?><br>
</html>
