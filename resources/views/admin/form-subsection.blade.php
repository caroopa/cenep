@extends('layouts.editor')

@section('content-editor')
  <div class="input-container">
    <label>Nombre:</label>
    <input class="form-control" type="text" name="nombre" value="{{ $method == 'PUT' ? $element->nombre : '' }}" required>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  @if ($belong->tipo == 'normal')
    <div class="textarea-container">
      <label>Contenido:</label>
      <textarea id="editor" name="contenido">{{ $method == 'PUT' ? $element->contenido : '' }}</textarea>
      <div class="invalid-feedback">
        Campo obligatorio.
      </div>
    </div>

    <script>
      (function() {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
          form.addEventListener('submit', function(event) {
            // Función para validar un CKEditor
            function validateCKEditor(editorName) {
              var editor = CKEDITOR.instances[editorName];

              if (editor && editor.getData().trim() === '') {
                // CKEditor está vacío, por lo que evitamos la validación del formulario
                event.preventDefault();
                event.stopPropagation();

                // Agregar clase de Bootstrap para resaltar el error
                editor.container.$.classList.add('is-invalid');

                // Hacer scroll hacia el CKEditor
                editor.container.$.scrollIntoView({
                  behavior: 'smooth',
                  block: 'center'
                });

                return false;
              }

              return true;
            }

            // Validar CKEditor para el campo "presentacion"
            var presentacionIsValid = validateCKEditor('editor');

            // Resto de la lógica de validación del formulario
            if (!form.checkValidity() || !presentacionIsValid || !contactoIsValid || !tituloIsValid) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add('was-validated');
          }, false);
        });
      })();
    </script>
  @elseif ($belong->tipo == 'article')
    <div class="textarea-container">
      <label>Descripción:</label>
      <textarea id="editor" name="descripcion">{{ $method == 'PUT' ? $element->descripcion : '' }}</textarea>
    </div>

    <div class="input-container">
      <label>Título para subpáginas:</label>
      <input class="form-control" type="text" name="subtitulo"
        value="{{ $method == 'PUT' ? $element->subtitulo : '' }}">
    </div>

    <div class="textarea-container">
      <label>Publicaciones:</label>
      <textarea id="editor1" name="publicaciones">{{ $method == 'PUT' ? $element->publicaciones : '' }}</textarea>
    </div>
  @endif

  @if ($method == 'PUT')
    <div class="input-container">
      <label>Enviar a:</label>
      <select class="form-select" name="seccion">
        @foreach ($sections_list as $section_e)
          <option value="{{ $section_e->id_seccion }}"
            @if ($element->id_seccion == $section_e->id_seccion) @selected(true) @endif>
            {{ $section_e->nombre }}
          </option>
        @endforeach
      </select>
    </div>
  @endif
@endsection
