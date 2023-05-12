<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENEP</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="shortcut icon" type="image/png" href="/img/favicon.ico">
</head>


<body>
    <?php include("../inc/header.php"); ?>

    <section class="body mx-auto">
        <div class="contenedor-body row">
            <?php include("../inc/menues/biblioteca.php"); ?>

            <div class="body-texto col-md-9 p-5">
                <div class="contenedor-contenido">
                    <div class="encabezado-separador">
                        <h1>Novedades mensuales</h1>
                    </div>
                    <div class="texto">
                        <p class="coloreado"><em>Visite periódicamente está página y consulte información sobre estos temas:</em></p>
                        <ul>
                            <li><strong>Boletín mensual de accesión </strong><br /><a href="http://152.170.77.44/wwwisis/ambi/form.htm" target="_blank">Consulte las adquisiciones bibliográficas catalogadas durante el último mes</a><a href="http://201.231.155.7/wwwisis/ambi/form.htm"><br /></a></li>
                            <li><strong>Tema del mes </strong><br /><a href="http://152.170.77.44/wwwisis/ambi/form.htm" target="_blank">Consulte la bibliografía disponible en la biblioteca del CENEP sobre temas de interés actual.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("../inc/footer.php"); ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>