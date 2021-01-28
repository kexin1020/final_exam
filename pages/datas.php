<?php
$pdo = "mysql:host=localhost;dbname=productdb;charset=utf8";
$usr = "productdb_admin";
$pswd = "admin123";

$pdos = new PDO($pdo,$usr,$pswd);
?>