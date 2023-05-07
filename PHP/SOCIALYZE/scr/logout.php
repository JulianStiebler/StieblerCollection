<?php
session_start();

$_SESSION["username"] = array();
session_destroy();
header('location: ../index.php');
?>