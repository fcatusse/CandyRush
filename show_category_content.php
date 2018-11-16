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
$product = new ProductAdmin();

$parent_name = $product->getCategoryReverse($_SESSION["category_id"]);

$array_cat = $category->displayChildrenCategory2($_SESSION["category_id"]);

foreach ($array_cat as $value) {
	$array = $category->displayCategory($value, "name");
	$name = $array["name"];
	//$cat_list .= '<p><li> <a href="show_category_content.php?catprod='.$value.'"> '.$name.' </a></li></p>';
	$cat_list .= '
    		<div class="col s12 m5">
      			<div class="card">
       				<div class="card-image">
          				<img src="sampleimg.jpg">
          				<span class="card-title">'.$name.'</span>
        			</div>
        			<div class="card-action">
          				<a href="show_category_content.php?catprod='.$value.'"> View </a>
        			</div>
      			</div>
    		</div>';
}

if (isset($_GET["catprod"])) {
	$id = $_GET["catprod"];
	$_SESSION["category_id"] = $id;
	header("Location: show_category_content.php");
	exit();
} 

if (isset($_GET["product_id"])) {
	$id = $_GET["product_id"];
	$_SESSION["product_id"] = $id;
	header("Location: show_product.php");
	exit();
} 

$array_prod = $category->getChildrenCategories($_SESSION["category_id"]);
//var_dump($array_prod)."<br>";
foreach ($array_prod as $value) {
	$query = 'SELECT name, price, id FROM products where category_id = '.$value;
	$result = $pdo->query($query);
	$d = $result->fetch(PDO::FETCH_OBJ);
	//var_dump($d);
	if ($d != FALSE) {
		$var = $d->name;
		//$prod_list .= '<p><li> <a href="show_product.php?product_id='.$d->id.'"> '.$var.' </li></p>';
		$prod_list .= '
    		<div class="col s12 m4">
      			<div class="card">
       				<div class="card-image">
          				<img src="image.jpg">
          				<span class="card-title">'.$var.'</span>
        			</div>
        			<div class="card-content">
          				<p>'.$d->price.' €</p>
        			</div>
        			<div class="card-action">
          				<a href="show_product.php?product_id='.$d->id.'"> View </a>
        			</div>
      			</div>
    		</div>';

	}
}

if ($cat_list == "" ) {
	$cat_list = "<h5><p>Nothing to show!</p></h5>";
}
if ($prod_list == "") {
	$prod_list = "<h5><p>Nothing to show!</p></h5>";
}



?>

<?php include_once "header.php" ;?>
<div class="container">
	<h6><a href="#" onClick="window.history.back();">Back</a></h6>
	<h4> <p> Category <?php echo $parent_name ;?> </p></h>
	<h5> <p> Categories : </p></h5>
	<div class="cards row"> <?php echo $cat_list; ?> </div>
   <h5> <p> Products: </p></h5>
    <div class="cards row"> <?php echo $prod_list; ?> </div>
    <h6><a href="#" onClick="window.history.back();">Back</a></h6>
</div>	
    
<?php include_once "footer.php";?>

