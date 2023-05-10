<?php
include("inc/util/db_connect.php");

if (isset($_POST["editar-novedad"])) {
    $contenido = $_POST["contenido"];
    $titulo = $_POST["titulo"];
    $id = $_POST["id"];

    $sql = "update Novedades";
    $sql .= " set Contenido = '" . $contenido . "', Titulo = '" . $titulo . "'";

    if (isset($_FILES["portada"])) {
        $dir_actual = getcwd();
        $uploadfile = "../img/portadas/" . $_FILES['portada']['name'];
        move_uploaded_file($_FILES['portada']['tmp_name'], $uploadfile);

        $sql1 = "select * from Novedades where id = " . $id;
        $rs0 = $mysql->query($sql1) or die($mysql->error);
        $rs = $rs0->fetch_array();

        $dir = "../img/portadas/" . $rs["Portada"];
        unlink($dir);

        $sql .= ", portada = '" . $_FILES['portada']['name'] . "'";
    }

    $sql .= " where ID = " . $id;

    $mysql->query($sql) or die($mysql->error);
}

include("inc/util/db_close.php");
?>