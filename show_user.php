<?php
include_once "connect_db.php";
include_once "config.php";
include_once "user_admin.php";

if ($_SESSION["is_admin"] == 1 ) {

	$user = new UserAdmin();
	$array = $user->displayUser($_SESSION["user_id"], "username", "email", "admin");
	//echo ($array["name"]);
	$username = $array["username"];
	$email = $array["email"];
	$admin  = $array["admin"];
	if ($admin == 1) {
		$is_admin = "Administrator";
	} else {
		$is_admin = "Regular user";
	}

} else {
	header("Location: index.php");
	exit;
}


?>

<?php include_once "header.php" ; ?>

<div class="container">

	<h6><a href="#" onClick="window.history.back();">Back</a></h6>
	<h4>User profile</h4>
	<div class="row">
    <div class="col s12 m7">
      <div class="card">
        <div class="card-image">
          <img src="headshot.jpg">
        </div>
        <div class="card-content">
          <h5><?php echo $username ;?></h5>
          <p><?php echo $email ;?></p>
          <p><?php echo $is_admin ;?></p>
        </div>
      </div>
    </div>
  </div>
  <h6><a href="#" onClick="window.history.back();">Back</a></h6>
</div>

<?php include_once "footer.php" ; ?>
