<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$admin = new UserAdmin();
$option = NULL;

$query = 'SELECT * FROM categories';
    $result = $pdo->query($query);
    var_dump($result);
    $d = $result->fetch(PDO::FETCH_OBJ);
    var_dump($d);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
         $option .= ' <option value="'.$d->name.'">"'.$d->name.'"</option>';
    }

?>

<!DOCTYPE html>
<html>
    <form action="signup.php" method="post">
        <p> Name : <input type="text" name="name" required> </p>
        <select name="bonbon">
            <?php echo $option ;?>
        </select>
        <p><input type="submit" value="OK"></p>
    </form>
</html>