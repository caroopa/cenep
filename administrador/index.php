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
    ?>

    <section>
        <div class="contenedor-presentacion">
            <h1>Bienvenido/a al Administrador <br> de la página del CENEP</h1>
        </div>
    </section>

    <?php include("inc/footer.php"); ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>