<?php
include_once "config.php";
include_once "connect_db.php";

nano bashrc 
alias ls = ;

private $_id;
private $_username;
private $_email;
private $_password;
private $_isAdmin;


class modifyUser {
    
    public function __construct($id, $username = NULL, $email = NULL, $password = NULL, $isAdmin = NULL )
    {
        $this->_username = $username;
		$this->_email = $email;
        $this->_password = $password;
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
        $query = 'INSERT INTO users (username, password, email, admin) VALUES ( "'.$user->_username.'", "'.$user->_password.'" ,"'.$user->_email.'", "'.$user->_isAdmin.'")';
        
        if ($this->_username != NULL)

		$req->execute();
	}
}
?>