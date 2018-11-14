<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
session_start();


if ($_POST != NULL) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$checked = $_POST["remember_me"];

	login($email, $password, $checked);
}


?>

<doctype html>
<html>
	<form method="post">
 		<p>Email: <input type="text" name="email" placeholder="Email"/></p>
 		<p>Password: <input type="password" name="password" placeholder="Password"/></p>
 		<p><input type="checkbox" name="remember_me"><label> Remember me</label></p>
 		<p><input type="submit" value="Submit"></p>
	</form>
</html>
