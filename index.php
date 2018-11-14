<?php
session_start();
if($_SESSION["name"])
{
    echo "Hello " .$_SESSION["name"]. "<br>";
}
else
{
    Header("Location: login.php");
}
?>