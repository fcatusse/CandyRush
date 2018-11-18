<?php
include_once "user_admin.php";
include_once "config.php";

$alert = "";

$_SESSION["search"] = FALSE;

if ($_POST!=NULL)
{
    if($_SESSION["email"])
    {
        $user = new UserAdmin();
        $array = $user->displayUser($_SESSION["id"], "password");
    } else if ($_COOKIE["email"]) {
        $user = new UserAdmin();
        $array = $user->displayUser($_COOKIE["id"], "password");
    } else {
        header("Location: login.php");
        exit;
    }

    $currentpassword = $array["password"];

    $status = true;
    
    if(strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 10)
    {   
        $status = false;
        echo "Invalid name <br>";
    }

    if($_POST["new_password"] == NULL) {
        $pass_null = true;
    } else {
        $pass_null = false;
    }

    if($_POST["new_password"] != NULL && (strlen($_POST["new_password"]) < 3 || strlen($_POST["new_password"]) > 10))
    {   
        $status = false;
        echo "Invalid password <br>";
    }

    if($_POST["new_password"] != $_POST["password_confirmation"])
    {
        $status = false;
        echo "Passwords don't match <br>";
    }        

    if(password_verify($_POST["currentpassword"], $currentpassword) == FALSE)
    {
        $status = false;
        echo "To save changes, current password must be valid <br>";
    } 

    if($status == true)                   
    {
        if ($pass_null == true) {
            $alert = $user->updateUser($_POST["name"], $_POST["email"], "" ,$_SESSION["id"]);
        } else {
            $alert = $user->updateUser($_POST["name"], $_POST["email"], $_POST["new_password"], $_SESSION["id"]);
        }
        
    }
    
}

$user2 = new UserAdmin();
$array2 = $user2->displayUser($_SESSION["id"],"username", "email");
$user_username = $array2["username"];
$user_email = $array2["email"];


?>

<?php include_once "header.php" ?>  
<div class= "container">
    <h5>Edit your information</h5>
    <p> <?php echo $alert;?></p>
    <form action="edit_self.php" method="post">
        <p> Name : <input type="text" name="name" value="<?php echo $user_username ;?>" /></p>
        <p> Email : <input type="text" name="email" value="<?php echo $user_email ;?>"/></p>
        <p> New Password : <input type="password" name="new_password" /></p>
        <p> Type new password again : <input type="password" name="password_confirmation" /></p>
        <p> To save changes, enter your current password : <input type="password" name="currentpassword" /></p>     
        <button type="submit" class="waves-effect waves-light btn-small onclick="return confirm('Send the form?')"> OK </button>
         <button type="button" onClick="window.location.href='admin.php'" class="waves-effect waves-light btn-small"> Cancel </button>
    </form>
</div>
<?php include_once "footer.php" ?>
