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
</head>

<body class="body-login">
    <div class="contenedor-login">
        <h1>Administrador</h1>
        <img src="/img/logo.png" alt="Logo">

        <?php include("config/login.php"); ?>

        <form class="form-login" method="POST">
            <input name="username" type="text" placeholder="Usuario">
            <input name="password" type="password" placeholder="Contraseña">
            <button class="btn-login" type="submit">Iniciar sesión</button>
        </form>
        
        <!-- <p class="olvidaste"><a href="#">¿Olvidate tu contraseña?</a></p> -->
        <p class="message"><strong><?php echo $mensaje_login ?></strong></p>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>