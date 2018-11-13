<?php

include_once "config.php";
include_once "connect_db.php";

class UserAdmin
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

	function __get ($arg)
	{
		return $this->$arg;
	}
	public function addUser ($username, $email, $password, $isAdmin = 0)
	{
		$query = 'INSERT INTO users (username, email, password, admin) VALUES ( "'.$username.'", "'.$email.'", "'.password_hash($password,PASSWORD_DEFAULT).'", "'.$isAdmin.'")';
		$rep = $this->_pdo->prepare($query);
		$rep->execute();

	}
	public function deleteUser ($id)
	{
		$query = 'DELETE FROM users WHERE id='.$id;
		$rep = $this->_pdo->prepare($query);
		$rep->execute();
	}

	public function updateUser ($username, $email, $password, $id)
	{
        $query = ('UPDATE users SET username = "'.$username.'" , email = "'.$email.'", password="'.password_hash($password,PASSWORD_DEFAULT).'" WHERE id="'.$id.'"');
        $rep = $this->_pdo->prepare($query);
		$rep->execute();
	}

	public function displayUser ($id, ...$arg)
	{
        $query = ("SELECT ".implode($arg,",")." FROM users WHERE id=".$id);
        $rep = $this->_pdo->prepare($query);
        $rep->execute();
		$data = $rep->fetch();
		return $data;
	}
}

/*
$a = new UserAdmin();
$b = $a->displayUser(3, "username", "email");
echo $b["username"]."<br>";
echo $b["email"];
*/

/*
$a->addUser("Leo", "Leo@funnyland.com", "qwerty");
$a->addUser("Bidon", "Bidon@bidonland.com", "dghdgshjgj");
$a->addUser("Bidon2", "Bidon@bidonland.com", "dghdgshjgj");
$a->updateUser("Leon", "Leonfunnyland.com", "azerty",1);
$a->delUser(2);
*/


?>