<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";


if ($_POST != NULL) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	if (isset($_POST["remember_me"])) {
		$checked = $_POST["remember_me"];
	} else {
		$checked = NULL;
	}
	
	login($email, $password, $checked);
}


?>

<!DOCTYPE html>
<html>
	<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <LINK href="css/materialize.min.css" rel="stylesheet" type="text/css">
    <LINK href="css/bonus.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
	</head>

  <header>
        <!-- NAV COMMENCE ICI --->
            <nav class="pink lighten-2">
            <div class="nav-wrapper">
            <span style="float:left;"><h5>Candy Rush </h5></span>
                <a href="#!" class="brand-logo center"><img src="lollipop.png">
                    <ul id="nav-mobile" class="right">
                            <li><a href="signup.php">Register</a></li>
                    </ul>
                    </div>
            </nav>
        </header>

  <div class="container">
  <div class="container">
		<div class="container">
    		<form method="post" class="container">
		<div class="">
        <div class="input-field">
          <input id="email" type="email" class="validate" name="email">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="">
        <div class="input-field">
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Password</label>
        </div>
	  </div>
	  <p>
      <label>
        <input type="checkbox" name="remember_me" />
        <span>Remember me</span>
      </label>
	</p>
	<button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
  <div class ="link">
  <p><a href="signup.php">New user? Sign up </a></p>
  </div>
  </div>
    </div>
    </div>
 
  </form>
  </html>
        
<!--<!DOCTYPE html>
<html>
	<form method="post">
 		<p>Email: <input type="text" name="email" placeholder="Email"/></p>
 		<p>Password: <input type="password" name="password" placeholder="Password"/></p>
 		<p><input type="checkbox" name="remember_me"><label> Remember me</label></p>
 		<p><input type="submit" value="Submit"></p>
	</form>
	<p></p>
	<p>New user? <a href="signup.php"> Sign up </a></p>
</html> --->
