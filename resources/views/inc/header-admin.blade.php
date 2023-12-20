<div class="logo-container-admin">
  <a href="{{ route('admin') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" class="img100"></a>
  <div class="buttons">
    <a href="{{ route('password') }}"><button class="btn btn-primary">Cambiar contraseña</button></a>
    <a href="{{ route('logout') }}"><button class="btn btn-outline-primary">Cerrar sesión</button></a>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('edit-index') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('selector-section') }}">Secciones</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('other') }}">Papelera</a></li>
      </ul>
    </div>
  </div>
</nav>
