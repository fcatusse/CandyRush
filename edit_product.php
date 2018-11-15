<?php
session_start();
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";
include_once "product_admin.php";

echo $_SESSION["product_id"];
echo "hello";
if($_POST!= NULL)
{
    $is_valid = TRUE;

    if(strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 10)
    {
        echo "Invalid candy name"."<br>";
        $is_valid = FALSE;
    }

    if($_POST["price"] == NULL || !is_numeric($_POST["price"]))
    {
        echo "Please enter valid price"."<br>";
        $is_valid = FALSE;
    }

    if ($is_valid == TRUE) {
        $user = new ProductAdmin();
        $user->updateProduct($_POST["name"], $_POST["price"], $_POST["candy"], $_SESSION["product_id"]);
        echo $_POST["name"] . $_POST["price"] . $_POST["candy"] . "Product ID: ". $_SESSION["product_id"];
    }
}
$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$option = NULL;
$query = 'SELECT * FROM categories';
$result = $pdo->query($query);
$d = $result->fetch(PDO::FETCH_OBJ);
while ($d = $result->fetch(PDO::FETCH_OBJ)) {
   $option .= ' <option value="'.$d->name.'">"'.$d->name.'"</option>';
}

?>

<!DOCTYPE html>
<html>
    <form action="edit_product.php" method="post">
        <p> Name : <input type="text" name="name" required> </p>
         <p> Price : <input type="text" name="price" required> </p>
        <p> Candy category: <select name="candy">
            <?php echo $option ;?>
        </select><p>
        <p><input type="submit" value="OK"></p>
    </form>
</html>