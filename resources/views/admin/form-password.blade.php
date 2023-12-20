@extends('layouts.admin')

@section('content-admin')
  <div class="encabezado-separador-admin">
    <h1>Cambiar contraseña</h1>
  </div>
  <div class="editor">

    <form action="{{ route('put-password') }}" method="POST" enctype='multipart/form-data' autocomplete="off" novalidate
      class="needs-validation" id="form" onsubmit="validatePasswords()">

      @csrf
      @method('PUT')

      <div class="input-container">
        <label>Contraseña anterior:</label>
        <input class="form-control" type="password" name="antigua" required>
      </div>

      <div class="input-container">
        <label>Contraseña nueva:</label>
        <input class="form-control" type="password" name="nueva1" id="nueva1" required>
      </div>

      <div class="input-container">
        <label>Repetir contraseña nueva:</label>
        <input class="form-control" type="password" name="nueva2" id="nueva2" required>
      </div>

      <p class="text-danger" id="error-pass" style="display: none">Las contraseñas nuevas no coinciden.</p>

      <div class="botones">
        <a href="{{ route('selector-section') }}">
          <button class="btn btn-outline-primary" type="button">Cancelar</button>
        </a>
        <button class="btn btn-primary" type="submit">Aceptar</button>
      </div>
    </form>
  </div>

  @isset($error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
      <i class="fa-solid fa-circle-check"></i>
      <p>{{ $error }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
      var alert = document.getElementById('alert');
      setTimeout(function() {
        alert.classList.remove('show');
      }, 3000);
    </script>
  @endisset

  @isset($success)
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
      <i class="fa-solid fa-circle-check"></i>
      <p>{{ $success }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
      var alert = document.getElementById('alert');
      setTimeout(function() {
        alert.classList.remove('show');
      }, 3000);
    </script>
  @endisset

  <script>
    (function() {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()

              // Obtener el primer elemento inválido dentro del formulario
              var invalidField = form.querySelector(':invalid')

              // Hacer scroll hacia el elemento inválido
              if (invalidField) {
                invalidField.scrollIntoView({
                  behavior: 'smooth',
                  block: 'center'
                })
              }
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()

    function validatePasswords() {
      const password = document.getElementById('nueva1');
      const confirmPassword = document.getElementById('nueva2');
      const error = document.getElementById('error-pass');
      if (password.value != confirmPassword.value) {
        password.setCustomValidity('Selecciona un archivo PDF válido');
        confirmPassword.setCustomValidity('Selecciona un archivo PDF válido');
        error.style.display = "block";
      } else {
        password.setCustomValidity('');
        confirmPassword.setCustomValidity('');
      }
    }
  </script>
@endsection
