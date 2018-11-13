<?php

include_once "config.php";
include_once "connect_db.php";
include_once "user_admin.php";

$a = new UserAdmin();
$a->addUser("superadmin", "superadmin@master-of-world.com", "superadmin",1);
$a->addUser("admin", "admin@master-of-world.com", "admin",1);

?>