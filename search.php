<?php

include_once "config.php";
include_once "connect_db.php";

class Search
{
	private $_pdo;

	function __construct ()
	{
		$this->_pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
	}

	public function do_search($name = null, $category_id = null, $price_min = -1, $price_max = -1, $order = "name ASC")
	{	
		// Search name (ANY category / ANY prices)
		if (!$category_id && ($price_min == -1 || $price_max == -1))
		{
			// echo "Search $name (ANY category_id: $category_id / ANY prices)\n";
			$query = ("SELECT id, name, price FROM products WHERE name LIKE '%".$name."%' ORDER by ".$order."");
		}
		
		// Search name (WITH category / ANY prices)
		else if ($category_id && ($price_min == -1 || $price_max == -1))
		{
			// echo "Search $name (WITH category_id: $category_id / ANY prices)\n";
			$query = ("SELECT id, name, price FROM products WHERE name LIKE '%".$name."%' AND category_id = ".$category_id." ORDER by ".$order."");
		}

		// Search name (ANY category / WITH prices)
		else if (!$category_id && ($price_min != -1 && $price_max != -1))
		{
			// echo "Search $name (ANY category_id / WITH prices: $price_min - $price_max)\n";
			$query = ("SELECT id, name, price FROM products WHERE name LIKE '%".$name."%' AND price BETWEEN ".$price_min." AND ".$price_max." ORDER by ".$order."");
		}

		// Search name (WITH category / WITH prices)
		else if ($category_id && ($price_min != -1 && $price_max != -1))
		{
			/// echo "Search $name (WITH category_id: $category_id / WITH prices: $price_min - $price_max)\n";
			$query = ("SELECT id, name, price FROM products WHERE name LIKE '%".$name."%' AND category_id = ".$category_id." AND price BETWEEN ".$price_min." AND ".$price_max." ORDER by ".$order."");
		}

        $rep = $this->_pdo->prepare($query);
      	$rep->execute();
		$arr = $rep->fetchall(PDO::FETCH_ASSOC);
		return $arr;
	}
}

/*

$a = new search();
// $arr = $a->do_search(null,null,null,null); 
// $arr = $a->do_search("Tagada"); 
// $arr = $a->do_search("Schtroumpfs",null,3,9);
// $arr = $a->do_search("Schtroumpfs",5,null,null);
$arr = $a->do_search("Schtroumpfs",5,3,9);

foreach ($arr as $value)
{
	echo $value["name"]."\n";
}

*/

?>
