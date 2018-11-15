<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
include_once "product_admin.php";
session_start();

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$query = 'SELECT * FROM products WHERE category_id="'.$_SESSION["category_id"].'"';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	$prod_list .= '<p><li> '.$d->name.' <li></p>';
    }
$query2 = 'SELECT * FROM categories WHERE parent_id="'.$_SESSION["category_id"].'"';
    $result2 = $pdo->query($query2);
	while ($d = $result2->fetch(PDO::FETCH_OBJ)) {
	 	$cat_list .= '<p><li> '.$d->name.'</li></p>';
    }
?>

<!DOCTYPE html>
<html>
	<?php
    echo $cat_list ;
    echo $prod_list ;  
    
	?>	
</html>