<?php

include_once "config.php";
include_once "connect_db.php";
include_once "search.php";
include_once "category_admin.php";

?>

<form action="search_result.php" method="post">
	<ul>
		<li>
			<label for="search">Product name</label>
			<input id="word" type="text" name="search" value="" placeholder="Type your search"/>
		</li>
	</ul>
	<ul>
		<li>
			<label for="category">Category</label>
			<select id="category" name="category">
			<option selected disabled value="">Select category</option>
			<option value="">All Categories</option>
			<?php
				$a = new CategoryAdmin();
				$arr = $a->displayAllCategory();
				foreach ($arr as $value)
				{
					echo "<option value={$value["id"]}>{$value["name"]}</option>";
				}
			?>
			</select>
		</li>
		<li>
			<label for="price">Price</label>
			<select id="price" name="price">
				<option selected disabled value="">Select price range</option>
				<option value="-1|-1">All Prices</option>
				<option value="0|4">0 to 4 €</option>
				<option value="4|8">4 to 8 €</option>
				<option value="8|12">8 to 12 €</option>
				<option value="12|9999">12 and more €</option>
			</select>
		</li>
	</ul>
	<input name="order" type="hidden" value="name ASC">
	<input type="submit" value="submit">
</form>
