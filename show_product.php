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

<div class = "container">
	<h6><a href="#" onClick="window.history.back();">Back</a></h6>
	<h4>Product page</h4>
	<div class = "cards row">
	<div class="col s12 m7">
      	<div class="card">
       		<div class="card-image">
          		<img src="image.jpg">
          		<span class="card-title"><?php echo $name ;?></span>
        	</div>
        	<div class="card-content">
          		<p><?php echo $price."€" ;?></p>
          		<p>Category : <?php echo $category ;?></p>
        	</div>
      	</div>
    </div>
    </div>
    <h6><a href="#" onClick="window.history.back();">Back</a></h6>
</div>	


<?php include_once "footer.php" ; ?>
