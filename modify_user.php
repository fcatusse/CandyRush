<?php
include_once "config.php";
include_once "connect_db.php";





class modifyUser {

    private $_id;
    private $_username;
    private $_email;
    private $_password;
    private $_isAdmin;
    
    public function __construct($id, $username = NULL, $email = NULL, $password = NULL, $isAdmin = NULL )
    {
        $this->_username = $username;
		$this->_email = $email;
        $this->_password = password_hash($password);
        $this->_id = $id;
        $this->_isAdmin = $isAdmin;
    }

    function __get ($arg)
	{
		return $this->$arg;
	}

    public function ModifyUserDB ($user)
	{
		$port = CONFIG_PORT;

		$pdo = connect_db("localhost", "root", "root", $port, "pool_php_rush");
        $query = ('UPDATE userinfo SET username = "'.$user->_username.'" , email = "'.$user->_email.'", password="'.$user->_password.'" WHERE id="'.$user->_id.'"');;
        $req = $pdo->prepare($query);
		$req->execute();
	}
}
?>