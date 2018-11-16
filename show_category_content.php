<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
include_once "product_admin.php";
include_once "category_admin.php";

$cat_list = ""; 
$prod_list = ""; 

//echo $_SESSION["category_id"];

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");

$category = new CategoryAdmin();
$array_cat = $category->displayChildrenCategory($_SESSION["category_id"]);

foreach ($array_cat as $value) {
	$cat_list .= '<p><li> '.$value.' </li></p>';
}

$array_prod = $category->getChildrenCategories($_SESSION["category_id"]);
//var_dump($array_prod)."<br>";

foreach ($array_prod as $value) {
	$query = 'SELECT name FROM products where category_id = '.$value;
	$result = $pdo->query($query);
	$d = $result->fetch(PDO::FETCH_OBJ);
	//var_dump($d);
	if ($d != FALSE) {
		$var = $d->name;
		$prod_list .= '<p><li> '.$var.' </li></p>';
	}
}

if ($cat_list == "" ) {
	$cat_list = "<p><li> Nothing to show </li></p>";
}
if ($prod_list == "") {
	$prod_list = "<p><li> Nothing to show </li></p>";
}



?>

<!DOCTYPE html>
<html>
	<p> Categories : </p>
	<ul>
		<?php echo $cat_list; ?> 
	</ul>
    <p> Products: </p>
    <UL>
    	<?php echo $prod_list ;?>	
    </UL>
    
</html>

