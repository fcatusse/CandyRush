<?php

include_once "config.php";
include_once "connect_db.php";

class ProductAdmin
{
	private $_name;
	private $_price;
	private $_category;
	private $_category_id;


	function __construct($name, $price, $category)
	{
		$this->_name = $name;
		$this->_price = $price;
		$this->_category = $category;
	}

	function __get($arg)
	{
		return $this->$arg;
	}

	function getCategory($category) {
		$pdo = connect_db("localhost", "root", "root", $port, "pool_php_rush");
		$query = 'SELECT id FROM categories WHERE name = "'.$category.'" ';
		$result = $pdo->query($query);
		$d = $result->fetch(PDO::FETCH_OBJ);
		if ($d == NULL) {
			return NULL;
		} else {
			return $d->id;
		}
	}

	public function AddProduct($product)
	{
		$port = CONFIG_PORT;
		$category = $product->category;
		$category_id = $this->getCategory($category);
		if ($category_id == NULL) {
			echo "This category doesn't exist.<br>";
		} else {
			$pdo = connect_db("localhost", "root", "root", $port, "pool_php_rush");
			$query = 'INSERT INTO products (name, price, category_id) VALUES ( "'.$product->_name.'", "'.$product->_price.'" ,"'.$product->_category_id.'")';
			$req = $pdo->prepare($query);
			$req->execute();
			echo "Product successfully added<br>";
		}

		
	}

}


?>