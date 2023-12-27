@extends('layouts.editor')

@section('content-editor')
  <p>Si no desea que tenga su propia página de contenido pero quiere que aparezca en la lista, puede solamente completar
    el campo obligatorio: nombre completo.</p>

  <div class="input-container">
    <label>Nombre completo:</label>
    <input class="form-control" type="text" name="nombre" value="{{ $method == 'PUT' ? $element->nombre : '' }}" required>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  <div class="input-container">
    <label>Mail:</label>
    <input class="form-control" type="email" name="mail" value="{{ $method == 'PUT' ? $element->mail : '' }}">
    <div class="invalid-feedback">
      Mail inválido.
    </div>
  </div>

  <div class="input-container">
    <label>CV:</label>
    @if ($method == 'PUT' && $element->cv != null)
      <p>El actual es <a href="{{ asset('docs/' . $element->cv) }}">este</a>.</p>
    @endif
    <input class="form-control" type="file" name="cv" accept=".pdf" id="cv" onchange="validatePDF()">
    <div class="invalid-feedback">
      Solamente se aceptan pdf.
    </div>
  </div>

  <div class="textarea-container">
    <label>Presentación:</label>
    <textarea id="editor" name="descripcion">{{ $method == 'PUT' ? $element->descripcion : '' }}</textarea>
  </div>

  <div class="checkboxs-container">
    <h3>Investigaciones:</h3>
    @foreach ($section->subsections as $subsection)
      <a class="link-vacio" data-bs-toggle="collapse" href="#subsection{{ $subsection->id_subseccion }}" role="button"
        aria-expanded="false">
        {{ $subsection->nombre }} <i class="fa-solid fa-chevron-down"></i>
      </a>
      <div class="collapse" id="subsection{{ $subsection->id_subseccion }}">
        <div class="card card-body">
          @foreach ($subsection->articles as $article)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $article->id_articulo }}" name="articulos[]"
                id="article{{ $article->id_articulo }}"
                {{ $method == 'PUT' && $element->hasArticle($article->getID()) ? 'checked' : '' }}>
              <label class="form-check-label" for="article{{ $article->id_articulo }}">
                {{ $article->titulo }}
              </label>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>

  <div class="textarea-container">
    <label>Otras investigaciones:</label>
    <p><small><em>No están relacionadas a un área temática. Se recomienda insertar cada una con viñetas para mantener
          el diseño de la página.</em></small></p>
    <textarea id="editor2" name="investigaciones">{{ $method == 'PUT' ? $element->investigaciones : '' }}</textarea>
  </div>

  <div class="textarea-container">
    <label>Publicaciones:</label>
    <textarea id="editor1" name="publicaciones">{{ $method == 'PUT' ? $element->publicaciones : '' }}</textarea>
  </div>

  @if ($method == 'PUT')
    <div class="input-container">
      <label>Enviar a:</label>
      <select class="form-select" name="subseccion">
        @foreach ($subsections as $subsection)
          <option value="{{ $subsection->id_subseccion }}"
            @if ($element->id_subseccion == $subsection->id_subseccion) @selected(true) @endif>
            {{ $subsection->nombre }}
          </option>
        @endforeach
      </select>
    </div>
  @endif
@endsection

@section('script')
  <script>
    function validatePDF() {
      var fileInput = document.getElementById('cv');
      var file = fileInput.files[0];

      if (file) {
        var fileName = file.name.toLowerCase();
        if (!fileName.endsWith('.pdf')) {
          fileInput.setCustomValidity('Selecciona un archivo PDF válido');
          fileInput.value = '';
        } else {
          fileInput.setCustomValidity('');
        }
      }
    }
  </script>
@endsection
