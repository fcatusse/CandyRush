<?php
include_once "user_admin.php";
include_once "config.php";
 $search = FALSE;

$pdo = NULL;
  if($_POST!= NULL)
  {
    $is_valid = TRUE;

    $pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email =?");
    $stmt->execute([$_POST["email"]]);
    $user = $stmt->fetch();
    if ($user) {
       echo "Email already used <br>";
       //throw New Exception('Email is already taken');
        $is_valid = FALSE;
    } 

    if(strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 10)
    {
        echo "Invalid name"."<br>";
        $is_valid = FALSE;
    }
    if(strlen($_POST["password"]) < 3 || strlen($_POST["password"]) > 10) {
        echo "Invalid password : too short or too long"."<br>";
        $is_valid = FALSE;
    }
    if ($_POST["password"] != $_POST["password_confirmation"] ) {
        echo "Password confirmation doesn't match the password"."<br>";
        $is_valid = FALSE;
    }
    if ($is_valid == TRUE) {
        $user = new UserAdmin();
        $user->addUser($_POST["name"], $_POST["email"],$_POST["password"], 0);
        Header("Location: login.php");
    }
  }

  if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1)
{
     $var = '<label> <input type="checkbox" /> <span>Make admin </span> </label>';
    $logout = '<p><a href="logout.php"> Logout </a></p>';
    $signin = "";
} else {
    $var = "";
    $logout = "";
    $signin = '<a href="login.php"> Already registered? Sign in';
}


?>

<<<<<<< HEAD
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
=======
<?php include_once "header.php" ; ?>

<div class="container">
>>>>>>> 86bd701ee923c3f9499397247ef60d41c652469e
    

    <header>
        <!-- NAV COMMENCE ICI --->
            <nav class="pink lighten-2">
            <div class="nav-wrapper">
                <a href="#!" class="brand-logo center"><img src="lollipop.png">
                    <ul id="nav-mobile" class="right">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="login.php">Log in</a></li>
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
          <input id="name" type="text" class="validate" name="name" required>
          <label for="name">Name</label>
        </div>
      </div>
		<div class="">
        <div class="input-field">
          <input id="email" type="email" class="validate" name="email" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="">
        <div class="input-field">
          <input id="password" type="password" class="validate" name="password" required>
          <label for="password">Password</label>
        </div>
	  </div>

      <div class="">
        <div class="input-field">
          <input id="password" type="password" class="validate" name="password_confirmation" required>
          <label for="password">Password confirmation</label>
        </div>
	  </div>

      <?php echo $var ; ?>  
	
	<button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
  </div>
    </div>
    </div>
 
  </form>

    <!--<form action="signup.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        */ <?php /* echo $var ; */ ?>  */ 
        <p><input type="submit" value="OK"></p>
    </form>
     <p> <a href="login.php"> Already registered? Sign in</p>--->
    </html>
