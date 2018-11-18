<?php
include_once "config.php";
include_once "connect_db.php";
include_once "search.php";
include_once "category_admin.php";
include_once "product_admin.php";
include_once "header.php";
// Do search
$product = new ProductAdmin();

if (!empty($_POST)) {
	$q_search = (isset($_POST['search'])) ? $_POST['search'] : null;
	$q_category = (isset($_POST['category'])) ? $_POST['category'] : null;
	$q_category_name = $product->getCategoryReverse($q_category);
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

<div class="container">

	<?php
		$msg  = "Results";
		$msg .= ($q_search != null) ? " for « {$q_search} » " : " for any word";
		$msg .= ($q_category != null) ? " in category {$q_category_name} " : "";
		$msg .= (($q_price[0] != -1) && ($q_price[1] != -1)) ? " with price between {$q_price[0]} € and {$q_price[1]} €" : "";
		$msg .= ".";
		echo "<h4>$msg</h4>";
	?>

	<div class="row">
		<div class="col m4 offset-m8">
			<form action="search_result.php" method="post">
				<div class="input-field" >
				<select id="order" name="order" onchange='if(this.value != 0) { this.form.submit(); }'>
					<option selected disabled value="">Filter by</option>
					<option value="name ASC">A->Z</option>
					<option value="name DESC">Z->A</option>
					<option value="price ASC">€->€€€</option>
					<option value="price DESC">€€€⁻>€</option>
				</select>
				<label for="order">Filter</label>
				<div>
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
		</div>
	</div>
</div>

<div class="row">
	<div class="col m12">
		
		<?php
			echo "<table><tr><th>Product Name</th><th>Price</th></tr>";
			foreach ($arr as $value)
			{
				$link  = '<tr>';
				$link .= '<td><a href=show_product.php?product_id=';
				$link .= $value['id'];
				$link .= '>';
				$link .= $value['name'];
				$link .= '</a></td>';
				$link .= '<td>';
				$link .= $value['price'];
				$link .= ' €</td>';
				$link .= '</tr>';
				echo $link;
			}
			echo "</table>";
		}
		?>
	</div>
</div> 

<script>
	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });
</script>

<?php
include_once "footer.php";
?>
