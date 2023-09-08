<?php 
session_start();
if(!isset($_SESSION["sesion"])) {
    header("Location:/administrador/login.php");
    exit;
}

if(isset($_POST["cerrar-sesion"])) {
    session_unset();
    session_destroy();
    header("Location:/administrador/login.php");
    exit;
}
?>