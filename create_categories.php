<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";
include_once "category_admin.php";
session_start();

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
            $cat->addCategory($_POST["category_name"]);
        }
        else{
            $cat->addCategory($_POST["category_name"], $_POST["parent_id"]);
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

<!DOCTYPE html>
<html>
    <form action="create_categories.php" method="post">
        <p> Category name : <input type="text" name="category_name" required> </p>
        <p> Candy category: <select name="parent_id">
        <option selected disabled value="">Select parent category</option>
            <?php echo $option ;?>
        </select><p>
        <p><input type="submit" value="OK"></p>
    </form>
</html>