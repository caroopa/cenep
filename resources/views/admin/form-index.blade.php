@extends('layouts.editor')

@section('content-editor')
  <div class="textarea-container">
    <label>Título:</label>
    <textarea id="editor" name="titulo">{{ $element->titulo }}</textarea>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  <div class="textarea-container">
    <label>Presentación:</label>
    <textarea id="editor1" name="presentacion">{{ $element->presentacion }}</textarea>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  <div class="input-container">
    <label>Imagen:</label>
    <p>La actual es <a href="{{ asset('img/index/' . $element->imagen) }}" target="_blank">esta</a>.</p>
    <input class="form-control" type="file" name="imagen" id="imagen" accept="image/*">
    <div class="invalid-feedback">
      Solamente se aceptan imágenes.
    </div>
  </div>

  <div class="textarea-container">
    <label>Contacto:</label>
    <textarea id="editor2" name="contacto">{{ $element->contacto }}</textarea>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>
@endsection

@section('script')
  <script>
    function validateImg() {
      var imageInput = document.getElementById('imagen');
      var file = imageInput.files[0];

      if (file) {
        var fileName = file.name.toLowerCase();
        if (!(/\.(jpg|jpeg|png|gif)$/i).test(fileName)) {
          // Establecer un mensaje de validación personalizado
          imageInput.setCustomValidity('Selecciona un archivo de imagen válido (JPEG, PNG, GIF)');
        } else {
          // Restablecer la validez del campo si es una imagen válida
          imageInput.setCustomValidity('');
        }
      }
    }

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

          // Validar CKEditor para el campo "contacto"
          var contactoIsValid = validateCKEditor('editor1');

          // Validar CKEditor para el campo "titulo"
          var tituloIsValid = validateCKEditor('editor2');

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
@endsection
