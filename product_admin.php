<?php
include_once "config.php";
include_once "connect_db.php";

class ProductAdmin
{
	private $_pdo;

	function __construct ()
	{
		try
		{
			$this->_pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
		}
		catch(PDOexception $e)
		{
			echo $e->getMessage();
		}
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

	public function addProduct($name, $price, $category)
	{
		$category_id = $this->getCategory($category);
		if ($category_id == NULL) {
			echo "This category doesn't exist.<br>";
		} else {
			$query = 'INSERT INTO products (name, price, category_id) VALUES ( "'.$name.'", "'.$price.'" ,"'.$category_id.'")';
			$req = $this->_pdo->prepare($query);
			$req->execute();
			echo "Product successfully added<br>";
		}
	}

	public function deleteProduct($id)
	{
		$query = 'DELETE FROM products WHERE id='.$id;
		$rep = $this->_pdo->prepare($query);
		$rep->execute();
		echo "Product successfully deleted<br>";
	}

	public function updateProduct($name, $price, $category, $id)
	{
        $category_id = $this->getCategory($category);
        $query = ('UPDATE products SET name = "'.$name.'", price="'.$price.'", category_id = "'.$category_id.'" WHERE id="'.$id.'"');
        $rep = $this->_pdo->prepare($query);
		$rep->execute();
		echo "Product successfully updated<br>";
	}

	public function displayProduct($id, ...$arg)
	{
        $query = ("SELECT ".implode($arg,",")." FROM products WHERE id=".$id);
        $rep = $this->_pdo->prepare($query);
        $rep->execute();
		$data = $rep->fetch();
		return $data;
	}
}

//$prod = new ProductAdmin();
//$prod->updateProduct("Fraise piquante", 2, "Tagada", 1);

?>