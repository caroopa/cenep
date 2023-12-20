@extends('layouts.editor')

@section('content-editor')
  <p>Si no desea que tenga su propia página de contenido pero quiere que aparezca en la lista, puede solamente completar
    los campos obligatorios: título y título corto.</p>

  <div class="input-container">
    <label>Título:</label>
    <input class="form-control" type="text" name="titulo" value="{{ $method == 'PUT' ? $element->titulo : '' }}" required>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  <div class="input-container">
    <label>Título corto:</label>
    <input class="form-control" type="text" name="titulo_corto"
      value="{{ $method == 'PUT' ? $element->titulo_corto : '' }}" required>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>

  <div class="textarea-container">
    <label>Contenido:</label>
    <textarea id="editor" name="contenido">{{ $method == 'PUT' ? $element->contenido : '' }}</textarea>
  </div>

  @if ($method == 'PUT')
    <div class="input-container">
      <label>Enviar a:</label>
      <select class="form-select" name="subseccion">
        {{-- <option value="">Ninguno</option> --}}
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
