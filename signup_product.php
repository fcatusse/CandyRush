<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";
include_once "product_admin.php";

$alert = "";

if($_POST!= NULL)
{
    $is_valid = TRUE;

    if(strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 30)
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
        $alert = $user->addProduct($_POST["name"], $_POST["price"], $_POST["candy"]);
        //Header("Location: signup_product.php");
        //exit;
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

<?php include_once "header.php" ; ?>

<div class="container">
    <h5> Add a new product</h5>
    <p> <?php echo $alert; ?> </p>
    <form action="signup_product.php" method="post">
        <p> Name : <input type="text" name="name" required> </p>
         <p> Price : <input type="text" name="price" required> </p>
        <p> Candy category: <select name="candy">
        <option selected disabled value="">Select parent category</option>
            <?php echo $option ;?>
        </select><p>
        <button type="submit" class="waves-effect waves-light btn-small onclick="return confirm('Send the form?')"> OK </button>
        <button type="button" onClick="window.location.href='admin.php'" class="waves-effect waves-light btn-small"> Cancel </button>
    </form>
    </div>
<?php include_once "footer.php" ; ?>
