<?php
include_once "connect_db.php";
include_once "login_function.php";
include_once "config.php";

$link = "cool";
$cat_list = NULL;

if($_SESSION["name"])
{
    $hello = "Hello " .$_SESSION["name"];
}
else
{
    Header("Location: login.php");
}

if($_SESSION["is_admin"] == 1 || $_COOKIE["is_admin"] == 1) {
	$link = '<p><a href="admin.php"> Admin dashboard </a><br></p>';
}

if (isset($_GET["viewprod"])) {
	$id = $_GET["viewprod"];
	$_SESSION["category_id"] = $id;
	header("Location: show_category_content.php");
	exit();
} 

$pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "pool_php_rush");
$query = 'SELECT * FROM categories WHERE parent_id=0';
	$result = $pdo->query($query);
	while ($d = $result->fetch(PDO::FETCH_OBJ)) {
	 	//$cat_list .= '<p><li> '.$d->name.' <a href="index.php?viewprod='.$d->id.'"> View </a></li></p>';
	 	$cat_list .= '
    		<div class="col s12 m4">
      			<div class="card">
       				<div class="card-image">
          				<img src="sampleimg.jpg">
          				<span class="card-title">'.$d->name.'</span>
        			</div>

        			<div class="card-action">
          				<a href="index.php?viewprod='.$d->id.'"> View </a>
        			</div>
      			</div>
    		</div>';
	}
?>

<?php include_once "header.php" ?>
	<div class="container">
		<h1><?php echo $hello; ?>!</h1>
		<h4><?php echo $link; ?></h4>
		<div class="cards row"> <?php echo $cat_list; ?> </div>
		<h5><p><a href="edit_self.php"> Edit profile </a></p></h5>
	</div>
<?php include_once "footer.php" ?>
