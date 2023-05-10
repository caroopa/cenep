<?php
$mensaje_login = "";
include("inc/util/db_connect.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
	$pass = $_POST["password"];

	$sql = "select * from Usuarios";
	$sql .= " where Username = '" . $username . "'";
	$sql .= " and Password = '" . $pass . "'";

	$sesion = $mysql->query($sql) or die($mysql->error);

	if($sesion->num_rows != 0) {
        session_start();
		$_SESSION["sesion"] = true;
		header('Location:index.php');		
	}
	else {
		$mensaje_login = "El usuario o la contraseña son incorrectos.</br>Intente nuevamente.";
	}
}

include("inc/util/db_close.php");
?>