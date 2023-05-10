<?php
$mysql = new mysqli("localhost","root","","CENEP");  
if ($mysql->connect_error)
      die("Problemas con la conexión a la base de datos.");
?>