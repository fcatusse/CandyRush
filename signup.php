<?php
session_start();
include_once "user_admin.php";
include_once "config.php";

  if($_POST!= NULL)
  {
    if(strlen($_POST["password"]) > 3 || strlen($_POST["password"]) < 15)
    {   
        if(strlen($_POST["name"]) > 2 || strlen($_POST["name"]) < 15)
        {
            if($_POST["password"] == $_POST["password_confirmation"])
            {
                if($_POST["checkbox"])
                {
                    $user = new UserAdmin();
                    $user->addUser($_POST["name"], $_POST["email"],$_POST["password"], 1);
                    Header("Location: login.php");
                }
                else
                {
                    $user = new UserAdmin();
                    $user->addUser($_POST["name"], $_POST["email"],$_POST["password"], 0);
                    Header("Location: login.php");
                }
            }
        }
    }
  }
  
if($_SESSION["is_admin"] == 0 || $_COOKIE["is_admin"] == 0)
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

<?php

if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1)

?>

<!DOCTYPE html>
<html> 
    <form action="inscription.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        <p> Admin <input type="checkbox" name="checkbox" > </p>
        <p><input type="submit" value="OK"></p>
</form>
</html>


