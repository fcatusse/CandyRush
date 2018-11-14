<?php
include_once "connect_db.php";
include_once "config.php";

function login($email, $password, $checked)
{
	$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
	$query = 'SELECT * FROM users WHERE email = "'.$email.'"';
	$result = $pdo->query($query);
	$d = $result->fetch(PDO::FETCH_OBJ);
	if ($d != FALSE) {
		$pass_hashed = $d->password;
		$name = $d->username;
		$id = $d->id;
		$is_admin = $d->admin;
		if (password_verify($password, $pass_hashed) == true) {
			$_SESSION["email"] = $email;
			$_SESSION["name"] = $name;
			$_SESSION["id"] = $id;
			$_SESSION["is_admin"] = $is_admin;
			if ($checked != NULL) {
				setcookie("remember_me", $name, time() + 60000);
				setcookie("email", $email, time() + 60000);
				setcookie("id", $id, time() + 60000);
				setcookie("is_admin", $is_admin, time() + 60000);
			}
			header("Location: index.php");
			exit();
		} else {
			echo "Incorrect email/password <br>";
		}
	} else {
		echo "Incorrect email/password <br>";
	}
}

?>