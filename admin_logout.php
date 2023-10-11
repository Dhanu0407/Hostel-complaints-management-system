<?php
session_start();

$_SESSION['admin_login'] = "Inactive";
header("location:h1.html");
?>