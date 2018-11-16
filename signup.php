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

<?php include_once "header.php" ; ?>

<div class="container">
    
    <form action="signup.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
         <?php echo $var ; ?>   
         <p><button type="submit" class="waves-effect waves-light btn-small onclick="return confirm('Send the form?')"> OK </button></p>
    </form>
     <p> <?php echo $signin ;?></p>
</div>

<?php include_once "footer.php" ; ?>
