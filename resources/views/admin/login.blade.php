<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CENEP</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">
</head>

<body class="body-login">
  <div class="contenedor-login">
    <h1>Administrador</h1>
    <img src="/img/logo.png" alt="Logo">
    <form class="form-login" method="POST">
      @csrf
      <input name="username" type="text" placeholder="Usuario">
      <input name="password" type="password" placeholder="Contraseña">
      <button class="btn-login" type="submit">Iniciar sesión</button>
    </form>
    <form action="{{ route('mail') }}" method="POST">
      @csrf
      <button class="olvidaste">¿Olvidaste la contraseña?</button>
    </form>
  </div>
</body>

@isset($error)
  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <i class="fa-solid fa-circle-check"></i>
    <p>{{ $error }}</p>
  </div>
@endisset

@if (session('sent'))
  <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
    <i class="fa-solid fa-circle-check"></i>
    <p>{{ session('sent') }}</p>
  </div>
@endif

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</html>
