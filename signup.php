<?php
include_once "user_admin.php";
include_once "config.php";
session_start();
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
       throw New Exception('Email is already taken');
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

?>

<!DOCTYPE html>
<html> 
    
    <form action="signup.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        <p><input type="submit" value="OK"></p>
    
    </form>
    
    </html>