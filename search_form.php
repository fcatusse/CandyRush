<?php

include_once "config.php";
include_once "connect_db.php";
include_once "search.php";
include_once "category_admin.php";

?>

	<div class="z-depth-1" style="padding:20px;">
		<form action="search_result.php" method="post">
			<div class="row">
				<div class="col m4">
					<label for="search">Product name</label>
					<input id="word" type="text" name="search" value="" placeholder="Type your search"/>
				</div>
				<div class="col m3">
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
				</div>
				<div class="col m3">
					<label for="price">Price</label>
					<select id="price" name="price">
						<option selected disabled value="">Select price range</option>
						<option value="-1|-1">All Prices</option>
						<option value="0|4">0 to 4 €</option>
						<option value="4|8">4 to 8 €</option>
						<option value="8|12">8 to 12 €</option>
						<option value="12|9999">12 and more €</option>
					</select>
				</div>
				<div class="col m2 center-align" style="margin-top:15px;">
					<input name="order" type="hidden" value="name ASC">
					<button type="submit" class="waves-effect waves-light btn-large">Search</button>
				</div>
			</div>
		</form>
	</div>
