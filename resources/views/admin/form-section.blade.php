@extends('layouts.editor')

@section('content-editor')
  @if ($method != 'PUT')
    <p style="margin-bottom: 0; text-align: center;">
      Define el tipo de contenido que tendrá esta sección. No podrá ser modificado.
    </p>
    <div class="radio-container">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="tipo" id="section-type" value="normal" required>
        <label class="form-check-label" for="section-type">Sin subpáginas</label>
        <div class="invalid-feedback">
          Campo obligatorio.
        </div>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="tipo" id="section-type" value="normal" required>
        <label class="form-check-label" for="section-type">Con subpáginas</label>
      </div>
    </div>
  @endif

  <div class="input-container">
    <label>Nombre:</label>
    <input class="form-control" type="text" name="nombre" value="{{ $method == 'PUT' ? $element->nombre : '' }}"
      required>
    <div class="invalid-feedback">
      Campo obligatorio.
    </div>
  </div>
@endsection
