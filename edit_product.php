<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";
include_once "product_admin.php";

$alert = "";
$option = "";

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
        $alert = $user->updateProduct($_POST["name"], $_POST["price"], $_POST["candy"], $_SESSION["product_id"]);
    }
}

$product = new ProductAdmin();
$array = $product->displayProduct($_SESSION["product_id"],"name","price", "category_id");
$name = $array["name"];
$price = $array["price"];
$category_id = $array["category_id"];
$category = $product->getCategoryReverse($category_id); 

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$option = NULL;
$query = 'SELECT * FROM categories';
$result = $pdo->query($query);
while ($d = $result->fetch(PDO::FETCH_OBJ)) {
   $option .= ' <option value="'.$d->name.'">"'.$d->name.'"</option>';
}

?>

<?php include_once "header.php" ?>
<div class="container">
    <h5>Edit a product</h5>
    <p> <?php echo $alert;?></p>
    <form action="edit_product.php" method="post">
        <p> Name : <input type="text" name="name" value= <?php echo $name ;?> required> </p>
         <p> Price : <input type="text" name="price" value= <?php echo $price ;?> required> </p>
        <p> Candy category (current: <?php echo $category ;?>) <select name="candy" >
        <p><?php echo $option ;?></p>
        </select><p>
        <button type="submit" class="waves-effect waves-light btn-small onclick="return confirm('Send the form?')"> OK </button>
        <button type="button" onClick="window.location.href='admin.php'" class="waves-effect waves-light btn-small"> Cancel </button>
    </form>
</div>

<?php include_once "footer.php" ?>
