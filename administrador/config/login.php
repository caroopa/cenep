<?php
error_reporting(E_ALL);

// Activar la visualización de errores en pantalla
ini_set('display_errors', 1);

$mensaje_login = "";
include("util/db_connect.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
	$pass = $_POST["password"];

	$sql = "select * from usuarios";
	$sql .= " where Username = '" . $username . "'";
	$sql .= " and Password = '" . $pass . "'";

	$sesion = $mysql->query($sql) or die($mysql->error);

	if($sesion->num_rows != 0) {
        session_start();
		$_SESSION["sesion"] = true;
		header('Location:index.php');
		exit;	
	}
	else {
		$mensaje_login = "El usuario o la contraseña son incorrectos.</br>Intente nuevamente.";
	}
}

include("util/db_close.php");
?>