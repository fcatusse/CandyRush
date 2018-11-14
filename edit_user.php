<?php
session_start();

if ($_POST!=NULL)
{
    if($_SESSION["email"])
    {
        $user = new UserAdmin();
        $currentpassword = $user->displayUser($_SESSION["id"], "password");
    }

    $status = true;
    
    if(strlen($_POST["password"]) < 3 || strlen($_POST["password"]) > 10)
    {   
        $status = false;
        echo "Invalid password <br>";
    }

    if(strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 10)
    {   
        $status = false;
        echo "Invalid name <br>";
    }
   
    if($_POST["password"] != $_POST["password_confirmation"])
    {
        $status = false;
        echo "Passwords don't match <br>";
    }        

    if($_POST["currentpassword"] != $currentpassword)
    {
        $status = false;
        echo "To save changes, current password must be valid <br>";
    }
                
    if($status == true)                   
    {
        $user = new UserAdmin();
        $user->updateUser($_POST["name"], $_POST["email"], $_POST["password"], $_SESSION["id"]);
    }
    
    if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1)
    {
        $var = '<p> Admin <input type="checkbox" name="checkbox" > </p>';
    }
}
?>

<!DOCTYPE html>
<html>    
    <form action="modify_account.php" method="post">
        <p> Name : <input type="text" name="name" value="<?php echo $_COOKIE["user"] ;?>" /></p>
        <p> Email : <input type="text" name="email" value="<?php echo $_COOKIE["email"] ;?>"/></p>
        <p> New Password : <input type="password" name="new_password" /></p>
        <p> Type new password again : <input type="password" name="password_confirmation" /></p>
        <p> To save changes enter current password : <input type="password" name="currentpassword" /></p>
        <?php echo $var ; ?>       
        <p><input type="submit" value="OK"></p>
    
    </form>
</html>