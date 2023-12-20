<table class="table table-striped table-bordered align-middle text-center">
  <thead>
    <tr>
      <th class="short-column"></th>
      <th class="text-start">Nombre</th>
      <th class="short-column">Editar</th>
      <th class="short-column">Borrar</th>
      @php
        $areSubsection = $elements->every(function ($element) {
            return $element->type() == 'subsection';
        });
        if ($areSubsection) {
            $arentNormal = $elements->every(function ($element) {
                return $element->tipo != 'normal';
            });
        }
      @endphp
      @if ($areSubsection && $arentNormal)
        <th style="width: 90px">Ver más</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($elements as $element)
      <tr>
        <th>{{ $loop->index + 1 }}</th>
        <td class="text-start">{{ $element->nombre() }}</td>
        <td>
          <button class="btn-vacio" data-bs-toggle="modal"
            data-bs-target="#modalEdit{{ $element->type() . $element->getID() }}">
            <i class="fa-solid fa-pen"></i>
          </button>
          </a>
        </td>
        <td>
          <button class="btn-vacio" data-bs-toggle="modal"
            data-bs-target="#modalDelete{{ $element->type() . $element->getID() }}">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
        @if ($element->type() == 'subsection' && $element->tipo != 'normal')
          <td>
            <button class="btn-vacio btn-collapse" data-bs-toggle="collapse"
              data-bs-target="#collapse{{ $element->getID() }}" aria-expanded="false">
              <i class="fa-solid fa-chevron-down"></i>
            </button>
          </td>
        @endif
      </tr>

      @if ($element->type() == 'subsection' && $element->tipo != 'normal')
        <tr>
          <td colspan="12">
            <div class="collapse" id="collapse{{ $element->getID() }}">
              <div class="encabezado-table">
                <h1>Vinculados a {{ $element->nombre() }}</h1>
              </div>
              <table class="table table-striped table-bordered align-middle text-center">
                <thead>
                  <tr>
                    <th class="short-column"></th>
                    <th class="text-start">Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($element->children as $child)
                    <tr>
                      <th>{{ $loop->index + 1 }}</th>
                      <td class="text-start">{{ $child->nombre() }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>