<?php

include_once "config.php";
include_once "connect_db.php";

class CategoryAdmin
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

	public function addCategory ($name, $parent_id = 0)
	{
		$query = "INSERT INTO categories (name, parent_id) VALUES ('".$name."', ".$parent_id.")";
		$rep = $this->_pdo->prepare($query);
		$rep->execute();

	}
	public function deleteCategory ($id)
	{
		$query = 'DELETE FROM categories WHERE id='.$id;
		$rep = $this->_pdo->prepare($query);
		$rep->execute();
	}
	public function displayCategory ($id, ...$arg)
	{
        $query = ("SELECT ".implode($arg,",")." FROM categories WHERE id=".$id);
        $rep = $this->_pdo->prepare($query);
        $rep->execute();
		$data = $rep->fetch();
		return $data;
	}
}
