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
		echo "User successfully added<br>";

	}
	public function deleteUser ($id)
	{
		$query = 'DELETE FROM users WHERE id='.$id;
		$rep = $this->_pdo->prepare($query);
		$rep->execute();
		echo "User successfully deleted<br>";
	}

	public function updateUser ($username, $email, $password, $id)
	{
        if ($password == NULL) {
        	echo "null<br>";
        	 $query = ('UPDATE users SET username = "'.$username.'" , email = "'.$email.'" WHERE id="'.$id.'"');
        } else {
        	$query = ('UPDATE users SET username = "'.$username.'" , email = "'.$email.'", password="'.password_hash($password,PASSWORD_DEFAULT).'" WHERE id="'.$id.'"');
        }
        $rep = $this->_pdo->prepare($query);
		$rep->execute();
		echo "User successfully updated<br>";
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


//$a = new UserAdmin();

//$a->addUser("flora", "flora@veto.com", "flora");
//$a->updateUser("Flora", "flora@veto.com","",1);




?>
