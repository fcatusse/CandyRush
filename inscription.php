<?php



  if($_POST!= NULL)
  {
    if(strlen($_POST["password"]) > 3 || strlen($_POST["password"]) < 15)
    {   
        if(strlen($_POST["name"]) > 2 || strlen($_POST["name"]) < 15)
        {
            if($_POST["password"] == $_POST["password_confirmation"])
            {
                $user = new UserAdmin();
                $user->addUser($_POST["name"], $_POST["email"],$_POST["password"], 0);
            }
        }
    }

  }

?>

<!DOCTYPE html>
<html> 
    
    <form action="modify_account.php" method="post">
        <p> Name : <input type="text" name="name" required;?>" /></p>
        <p> Email : <input type="email" name="email" required;?>"/></p>
        <p> Password : <input type="password" name="password" required /></p>
        <p> Password confirmation : <input type="password" name="password_confirmation" required /></p>
        <p><input type="submit" value="OK"></p>
    
    </form>
    
    </html>