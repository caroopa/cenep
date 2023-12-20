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
    </div>
  @elseif ($belong->tipo == 'article')
    <div class="textarea-container">
      <label>Descripción:</label>
      <textarea id="editor" name="descripcion">{{ $method == 'PUT' ? $element->descripcion : '' }}</textarea>
    </div>

    <div class="input-container">
      <label>Título para subpáginas:</label>
      <input class="form-control" type="text" name="subtitulo" value="{{ $method == 'PUT' ? $element->subtitulo : '' }}">
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
