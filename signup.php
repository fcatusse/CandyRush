<?php

include_once "user_admin.php";
include_once "config.php";

  if($_POST!= NULL)
  {
    $is_valid = TRUE;

    if ($name == NULL || strlen($name) < 3 || strlen($name) > 10) {
        echo "Invalid name"."<br>";
        $is_valid = FALSE;
    }
    if ($password == NULL || strlen($password) < 3 || strlen($password) > 10) {
        echo "Invalid password : too short or too long"."<br>";
        $is_valid = FALSE;
    }
    if ($password_confirm == NULL || $password_confirm != $password ) {
        echo "Password confirmation doesn't match the password"."<br>";
        $is_valid = FALSE;
    }

    if ($is_valid = TRUE) {
        $user = new UserAdmin();
        $user->addUser($_POST["name"], $_POST["email"],$_POST["password"], 0);
    }
  }

?>

<!DOCTYPE html>
<html> 
    
    <form action="inscription.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        <p><input type="submit" value="OK"></p>
    
    </form>
    
    </html>