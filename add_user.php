<?php

include_once "config.php";
include_once "connect_db.php";

class AddUser
{
	private $_username;
	private $_email;
	private $_password;
	private $_isAdmin;

	function __construct($username, $email, $password, $isAdmin = 0)
	{
		$this->_username = $username;
		$this->_email = $email;
		$this->_password = $password;
	}

	function __get ($arg)
	{
		return $this->$arg;
	}

	public function AddUserToDB ($user)
	{
		$port = CONFIG_PORT;

		$pdo = connect_db("localhost", "root", "root", $port, "pool_php_rush");
		$query = 'INSERT INTO users (username, password, email, admin) VALUES ( "'.$user->_username.'", "'.$user->_password.'" ,"'.$user->_email.'", "'.$user->_isAdmin.'")';
		$req = $pdo->prepare($query);
		$req->execute();
	}

}

?>