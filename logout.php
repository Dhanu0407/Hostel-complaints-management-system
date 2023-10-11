<?php
session_start();

$_SESSION['sid'] = null;
header("location:h1.html");
?>