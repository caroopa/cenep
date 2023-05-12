<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENEP</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/administrador.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="shortcut icon" type="image/png" href="/img/favicon.ico">
</head>

<body>
    <?php
    include("config/sesion.php");
    include("inc/header.php");

    if (!isset($_GET["modo"])) {
        include("inc/util/db_connect.php");
        $sql = "select * from Novedades where ID=" . $_GET["id"];
        $rs0 = $mysql->query($sql) or die($mysql->error);
        if ($rs0->num_rows != 0) {
            $rs = $rs0->fetch_array();
    ?>

            <section>
                <div class="division-seccion editor-contenedor">
                    <div class="encabezado-separador">
                        <h1>Editar Novedad N°<?php echo $rs["ID"]; ?></h1>
                    </div>

                    <div class="editor">
                        <form action="editar-novedad.php?modo=2" method="POST" enctype='multipart/form-data'>
                            <input type="hidden" name="id" value="<?php echo $rs["ID"]; ?>">
                            <div class="input-container">
                                <p>Título:</p>
                                <input type="text" name="titulo" value="<?php echo $rs["Titulo"]; ?>">
                            </div>
                            <div class="input-container">
                                <p>Portada:</p>
                                <input type="file" id="portada" name="portada" />
                            </div>
                            <div class="textarea-container">
                                <p class="contenido">Contenido:</p>
                                <textarea name="contenido" id="editor"><?php echo $rs["Contenido"]; ?></textarea>
                            </div>
                            <div class="botones">
                                <a href="novedades.php"><button class="btn-enviar" type="reset" onclick="window.history.back();">
                                        Cancelar</button></a>
                                <button class="btn-enviar" type="submit" name="editar-novedad">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </section>

        <?php } else { ?>
            <section>
                <div class="contenedor-presentacion">
                    <div class="volver-novedades">
                        <p>No existe la novedad solicitada.</p>
                        <a href="novedades.php"><button class="btn-logout">Volver</button></a>
                    </div>
                </div>
            </section>
        <?php
        }
        include("inc/util/db_close.php");
    } else {
        ?>

        <section>
            <div class="contenedor-presentacion">
                <div class="volver-novedades">
                    <?php include("config/editar-novedad.php"); ?>
                    <p>Novedad editada exitosamente.</p>
                    <a href="novedades.php"><button class="btn-logout">Volver</button></a>
                </div>
            </div>
        </section>

    <?php
    }
    include("inc/footer.php");
    ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<?php include("inc/footer_ckeditor.php"); ?>

</html>