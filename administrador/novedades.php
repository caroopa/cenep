<?php include("config/sesion.php"); ?>

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
    include("inc/header.php");
    ?>

    <section>
        <div class="novedades2">
            <div class="encabezado-separador">
                <h1>Novedades</h1>
            </div>
            <div class="nueva-novedad">
                <a href="nueva-novedad.php"><button class="btn-logout">Nueva novedad</button></a>
            </div>
            <div class="row lh-sm novedades-container">

                <?php
                include("inc/util/db_connect.php");
                $sql = "select * from Novedades";
                $rs0 = $mysql->query($sql) or die($mysql->error);
                if ($rs0->num_rows != 0) {
                    while ($rs = $rs0->fetch_array()) {
                ?>
                        <div class="col-md-3 mb-4">
                            <?php $url = "../img/portadas/" . $rs["Portada"]; ?>
                            <a href="editar-novedad.php?id=<?php echo $rs["ID"]; ?>">
                                <div class="novedad" style="background-image: linear-gradient(rgba(0, 0, 0, .5), 
                                    rgb(0, 0, 0, .3)), url(<?php echo $url; ?>);">
                                    <p><?php echo $rs["Titulo"]; ?></p>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                }
                include("inc/util/db_close.php");
                ?>

            </div>
        </div>
    </section>

    <?php include("inc/footer.php"); ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>