<div class="modal fade" id="modalEdit{{ $element->type() . $element->getID() }}" data-bs-backdrop="static"
  data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="botones">
        <form action="{{ route('put-' . $element->type(), ['id_element' => $element->getID()]) }}" method="POST">
          @csrf
          @method('PUT')

          @if ($element->type() == 'subsection')
            <input type="hidden" value="{{ $element->nombre }}" name="nombre">
            @php
              $filteredSections = $parent->filter(function ($section) use ($element) {
                  return $section->tipo == $element->tipo;
              });
            @endphp
            <div class="input-container">
              <label>Que pertenezca a:</label>
              <select class="form-select" name="seccion">
                @foreach ($filteredSections as $section)
                  <option value="{{ $section->getID() }}">
                    {{ $section->nombre() }}
                  </option>
                @endforeach
              </select>
            </div>
          @else
            @php
              $filteredSubsections = $parent->filter(function ($subsection) use ($element) {
                  return $subsection->tipo == $element->type();
              });
            @endphp
            @if ($element->type() == 'article')
              <input type="hidden" value="{{ $element->titulo }}" name="titulo">
              <input type="hidden" value="{{ $element->titulo_corto }}" name="titulo_corto">
            @else
              <input type="hidden" value="{{ $element->nombre }}" name="nombre">
            @endif

            <div class="input-container">
              <label>Que pertenezca a:</label>
              <select class="form-select" name="subseccion">
                @foreach ($filteredSubsections as $subsection)
                  <option value="{{ $subsection->getID() }}">
                    {{ $subsection->nombre() }}
                  </option>
                @endforeach
              </select>
            </div>
          @endif

          <div class="botones mt-4">
            <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal" aria-label="Close">
              Cancelar</button>
            <button class="btn btn-primary" type="submit">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
