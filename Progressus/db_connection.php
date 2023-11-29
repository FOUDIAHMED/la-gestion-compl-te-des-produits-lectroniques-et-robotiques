<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "gestion_de_produit_stock";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "<script>alert('login is valid');</script>";
}
?>