<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
include_once "category_admin.php";

$alert = "";

if($_POST["category_name"]!= NULL)
{
    $is_valid = TRUE;

    if(strlen($_POST["category_name"]) < 3 || strlen($_POST["category_name"]) > 30)
    {
        echo "Invalid category name"."<br>";
        $is_valid = FALSE;
    }
    if ($is_valid == TRUE) {
        $cat = new CategoryAdmin();
        if($_POST["parent_id"] == NULL)
        {
            $alert = $cat->addCategory($_POST["category_name"]);
        }
        else {
            $alert = $cat->addCategory($_POST["category_name"], $_POST["parent_id"]);
        }        
    }
}

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$option = NULL;
$query = 'SELECT * FROM categories';
$result = $pdo->query($query);
$d = $result->fetch(PDO::FETCH_OBJ);
while ($d = $result->fetch(PDO::FETCH_OBJ)) {
   $option .= ' <option value="'.$d->id.'">"'.$d->name.'"</option>';
}

?>
<?php include_once "header.php" ?>
<div class= "container">
    <h5>Add a new category</h5>
    <p> <?php echo $alert;?></p>
    <form action="create_categories.php" method="post">
        <p> Category name : <input type="text" name="category_name" required> </p>
        <p> Candy category: <select name="parent_id">
        <option selected disabled value="">Select parent category</option>
            <?php echo $option ;?>
        </select><p>
        <p><button type="submit" class="waves-effect waves-light btn-small onclick="return confirm('Send the form?')"> OK </button></p>
    </form>
    </div>
<?php include_once "footer.php" ?>
