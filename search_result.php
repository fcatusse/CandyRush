<?php

include_once "config.php";
include_once "connect_db.php";
include_once "search.php";
include_once "category_admin.php";

include_once "header.php";

// Do search
if (!empty($_POST)) {

	$q_search = (isset($_POST['search'])) ? $_POST['search'] : null;
	$q_category = (isset($_POST['category'])) ? $_POST['category'] : null;
	$q_price = (isset($_POST['price'])) ? explode("|", $_POST['price']) : [-1,-1];
	$q_order = (isset($_POST['order'])) ? $_POST['order'] : null;

	$a = new search();
	$arr = $a->do_search($q_search ,$q_category ,$q_price[0] ,$q_price[1], $q_order);

// Display search

	if (isset($_GET["showprod"])) {
		$id = $_GET["showprod"];
		$_SESSION["product_id"] = $id;
		header("Location: show_product.php");
		exit();
	} 

?>

	<form action="search_result.php" method="post">
		<label for="order">Filter</label>
		<select id="order" name="order" onchange='if(this.value != 0) { this.form.submit(); }'>
			<option selected disabled value="">Filter by</option>
			<option value="name ASC">A->Z</option>
			<option value="name DESC">Z->A</option>
			<option value="price ASC">€->€€€</option>
			<option value="price DESC">€€€⁻>€</option>
		</select>
		<?php 
			if (isset($_POST['search']))
			{
				echo '<input name="search" type="hidden" value="'.$_POST['search'].'">';
			}
			if (isset($_POST['category']))
			{
				echo '<input name="category" type="hidden" value="'.$_POST['category'].'">';
			}
			if (isset($_POST['price']))
			{
				echo '<input name="price" type="hidden" value="'.$_POST['price'].'">';
			}
		?>
	</form>

<?php

	$msg  = "Results";
	$msg .= ($q_search != null) ? " for « {$q_search} » " : " for any word";
	$msg .= ($q_category != null) ? " in category {$q_category} " : "";
	$msg .= (($q_price[0] != -1) && ($q_price[1] != -1)) ? " with price between {$q_price[0]} € and {$q_price[1]} €" : "";
	$msg .= ".";

	echo "<h3>$msg</h3>";

	echo "<ul>";



	foreach ($arr as $value)
	{
		$link  = '<a href=show_product.php?product_id=';
		$link .= $value['id'];
		$link .= '>';
		$link .= $value['name'];
		$link .= '</a><br>';
		echo $link;

	}
	echo "</ul>";
}

include_once "footer.php";

?>
