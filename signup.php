<?php
session_start();
include_once "user_admin.php";
include_once "config.php";

  if($_POST!= NULL)
  {
<<<<<<< HEAD
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
=======
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
>>>>>>> 699ef6b127f8117d067e5994fb477d1e154417bc
  }
  
if($_SESSION["is_admin"] == 0 || $_COOKIE["is_admin"] == 0) :

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

<?php endif; ?>
<?php

if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1) :

?>

<!DOCTYPE html>
<html> 
    <form action="signup.php" method="post">
        <p> Name : <input type="text" name="name" required;?> </p>
        <p> Email : <input type="email" name="email" required;?> </p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        <p> Admin <input type="checkbox" name="checkbox" > </p>
        <p><input type="submit" value="OK"></p>
</form>
</html>

<?php endif; ?>