@extends('layouts.admin')

@section('content-admin')
  <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

  @php
    if ($method == 'PUT') {
        if ($type[0] == 'index') {
            $h1 = 'Editar <span class="important">HOME</span>';
            $route_param = [];
        } else {
            $h1 = 'Editar <span class="important">' . strtoupper($element->nombre()) . '</span>';
            $route_param = ['id_element' => $element->getID()];
        }
        $route = 'put-' . $type[0];
    } else {
        if (isset($belong)) {
            $h1 = 'Agregar <span class="important">';
            $h1 .= strtoupper($type[1]);
            $h1 .= '</span><br>en<span class="important"> ';
            $h1 .= strtoupper($belong->nombre()) . '</span>';
            $route_param = ['id_belong' => $belong->getID()];
        } else {
            $h1 = 'Agregar <span class="important">SECCION</span>';
            $route_param = [];
        }
        $route = 'post-' . $type[0];
    }
  @endphp

  <div class="encabezado-separador-admin">
    <h1>{!! $h1 !!}</h1>
  </div>
  <div class="editor">

    <form action="{{ route($route, $route_param) }}" method="POST" enctype='multipart/form-data' autocomplete="off"
      novalidate class="needs-validation" id="form">

      @csrf
      @method($method)
      @yield('content-editor')

      <div class="botones">
        <a href="{{ route('selector-section') }}">
          <button class="btn btn-outline-primary" type="button">Cancelar</button>
        </a>
        <button class="btn btn-primary" type="submit">Aceptar</button>
      </div>
    </form>
  </div>

  @isset($msg)
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
      <i class="fa-solid fa-circle-check"></i>
      <p>{{ $msg }}</p>
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
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');

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
  </script>
  @yield('script')
@endsection
