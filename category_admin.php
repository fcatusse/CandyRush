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
	
	public function displayAllCategory()
	{
        $query = ("SELECT * FROM categories");
        $rep = $this->_pdo->prepare($query);
        $rep->execute();
		$arr = $rep->fetchall(PDO::FETCH_ASSOC);
		return $arr;
	}
	
	public function displayChildrenCategory ($parent_id)
	{
		$res = array();
        $query = "SELECT name FROM categories WHERE parent_id = ".$parent_id;
        $result = $this->_pdo->query($query);
		while ($d = $result->fetch(PDO::FETCH_OBJ)) {
			//echo $d->id;
			array_push($res, $d->name);
		}
		return($res);
	}
	
	function getChildrenCategories($parent_id) {

	$array_result = array();
	$res = array();
//var_dump($res);
	$query = "SELECT id FROM categories WHERE parent_id = ".$parent_id;
	$result = $this->_pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
		echo $d->id;
		array_push($res, $d->id);
	}
//var_dump ($res);
	if (count($res) == 0) {
		return NULL;
	}
	$array_result = array_merge($array_result, $res);
	array_push($array_result, strval($parent_id));

	while ($end == FALSE) {
		$query = 'SELECT id 
		FROM categories 
		WHERE parent_id IN (' . implode(',', array_map('intval', $res)) . ')';
		$result = $this->_pdo->query($query);
		$res = array();
		while ($d = $result->fetch(PDO::FETCH_OBJ)) {
			array_push($res, $d->id);
		}
		if (count($res) != 0) {
			$array_result = array_merge($array_result, $res);
		} else {
			$end = TRUE;
		}
	}

	return $array_result;
	}

}

/*$a = new CategoryAdmin();
$a->addCategory("Tagada");
$a->addCategory("Gelifies");
$a->addCategory("Chamallows");
$a->addCategory("Reglisse");
$a->addCategory("Originale",1);
$a->addCategory("Pink",1);
$a->addCategory("Schtroumpfs",2);
$a->addCategory("Croco",2);
$a->addCategory("Ours",2);
$a->addCategory("Oasis",2);
$a->addCategory("Oeufs",2);
$a->addCategory("Chamalows",3);
$a->addCategory("Chamalows Choco",3);
$a->addCategory("Chamalows Schtroumpfs",3);
$a->addCategory("Rainbollows",3);
$a->addCategory("Rotella",4);
$a->addCategory("Cocobat",4);
$a->addCategory("Car en Sac",4);
$a->addCategory("Painzan",4);
$a->addCategory("Painzan",4);*/

?>
