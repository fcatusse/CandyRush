<?php

session_start();

session_unset();
session_destroy();
setcookie("remember_me", null, 1);
setcookie("email", null, 1);
setcookie("id", null, 1);
setcookie("is_admin", null, 1);
header("Location: login.php");
exit();

?>
