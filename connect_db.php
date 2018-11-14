<?php

const ERROR_LOG_FILE = "../log.txt";

function connect_db($host, $username, $passwd, $port, $db)
{
	try
	{
		$db = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $username, $passwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (PDOException $e)
	{
		file_put_contents(ERROR_LOG_FILE, $e->getMessage()."\n", FILE_APPEND);
		die("PDO ERROR : " . $e->getMessage() . " storage in " . ERROR_LOG_FILE . "\n");
	}

	return $db;

}

//connect_db("localhost", "root", "camille123", 3306, "registration");


?>