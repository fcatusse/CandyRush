<?php

include_once "config.php";
include_once "connect_db.php";

class ProductAdmin
{
	private $_pdo;

	function __construct()
	{
		$this->_pdo = $pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
	}

	function __get($arg)
	{
		return $this->$arg;
	}

	function getCategory($category) {

		$query = 'SELECT id FROM categories WHERE name = "'.$category.'" ';
		$result = $this->_pdo->query($query);
		$d = $result->fetch(PDO::FETCH_OBJ);
		if ($d == NULL) {
			return NULL;
		} else {
			return $d->id;
		}
	}

	public function AddProduct($name, $price, $category)
	{
		$category_id = $this->getCategory($category);
		if ($category_id == NULL) {
			echo "This category doesn't exist.<br>";
		} else {
			$query = 'INSERT INTO products (name, price, category_id) VALUES ( "'.$product->_name.'", "'.$product->_price.'" ,"'.$product->_category_id.'")';
			$req = $this->_pdo->prepare($query);
			$req->execute();
			echo "Product successfully added<br>";
		}
	}
}


?>