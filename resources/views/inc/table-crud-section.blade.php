<table class="table table-striped table-bordered align-middle text-center">
  <thead>
    <tr>
      <th class="short-column"></th>
      <th class="text-start">Nombre</th>
      <th class="short-column">Editar</th>
      <th class="short-column">Borrar</th>
      @if ($section->tipo != 'normal')
        <th style="width: 90px">Ver más</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($section->subsections as $subsection)
      <tr
        class="{{ isset($new) && isset($new_type) && $subsection->getID() == $new && $subsection->type() == $new_type ? 'titilar' : '' }}"
        id="{{ $subsection->type() . $subsection->getID() }}">
        <th>{{ $loop->index + 1 }}</th>
        <td class="text-start">{{ $subsection->nombre() }}</td>
        <td>
          <a
            href="{{ route('edit-' . $subsection->type(), ['id_element' => $subsection->getID(), 'id_belong' => $section->getID()]) }}">
            <i class="fa-solid fa-pen"></i>
          </a>
        </td>
        <td>
          <button class="btn-vacio" data-bs-toggle="modal"
            data-bs-target="#modalDelete{{ $subsection->type() . $subsection->getID() }}">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
        @if ($section->tipo != 'normal')
          <td>
            <button class="btn-vacio btn-collapse" data-bs-toggle="collapse"
              data-bs-target="#collapse{{ $subsection->getID() }}"
              aria-expanded="{{ $subsection->getID() == $expand ? 'true' : 'false' }}">
              <i class="fa-solid fa-chevron-down"></i>
            </button>
          </td>
        @endif
      </tr>

      @if ($section->tipo == 'article')
        <tr>
          <td colspan="12">
            <div class="collapse {{ $subsection->getID() == $expand ? 'show' : '' }}"
              id="collapse{{ $subsection->getID() }}">
              <div class="encabezado-table">
                <h1>Investigaciones de {{ $subsection->nombre() }}</h1>
                <div class="btn-container">
                  <a href="{{ route('add-article', ['id_belong' => $subsection->getID()]) }}">
                    <button class="btn-encabezado"><i class="fa-solid fa-circle-plus"></i>Agregar</button>
                  </a>
                </div>
              </div>
              <table class="table table-striped table-bordered align-middle text-center">
                <thead>
                  <tr>
                    <th class="short-column"></th>
                    <th class="text-start">Nombre</th>
                    <th class="short-column">Editar</th>
                    <th class="short-column">Borrar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subsection->articles as $article)
                    <tr
                      class="{{ isset($new) && isset($new_type) && $article->getID() == $new && $article->type() == $new_type ? 'titilar' : '' }}"
                      id="{{ $article->type() . $article->getID() }}">
                      <th>{{ $loop->index + 1 }}</th>
                      <td class="text-start">{{ $article->nombre() }}</td>
                      <td>
                        <a
                          href="{{ route('edit-article', ['id_element' => $article->getID(), 'id_belong' => $subsection->getID()]) }}">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </td>
                      <td>
                        <button class="btn-vacio" data-bs-toggle="modal"
                          data-bs-target="#modalDelete{{ $article->type() . $article->getID() }}">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              {{-- MODAL DELETE ARTICLE --}}
              @foreach ($subsection->articles as $article)
                @include('inc.modal-delete', ['element' => $article])
              @endforeach
            </div>
          </td>
        </tr>
      @elseif ($section->tipo == 'inv')
        <tr>
          <td colspan="12">
            <div class="collapse {{ $subsection->getID() == $expand ? 'show' : '' }}"
              id="collapse{{ $subsection->getID() }}">
              <div class="encabezado-table">
                <h1>Investigadores de {{ $subsection->nombre() }}</h1>
                <div class="btn-container">
                  <a href="{{ route('add-inv', ['id_belong' => $subsection->getID()]) }}">
                    <button class="btn-encabezado"><i class="fa-solid fa-circle-plus"></i>Agregar</button>
                  </a>
                </div>
              </div>
              <table class="table table-striped table-bordered align-middle text-center">
                <thead>
                  <tr>
                    <th class="short-column"></th>
                    <th class="text-start">Nombre</th>
                    <th class="short-column">Editar</th>
                    <th class="short-column">Borrar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subsection->invs as $inv)
                    <tr
                      class="{{ isset($new) && isset($new_type) && $inv->getID() == $new && $inv->type() == $new_type ? 'titilar' : '' }}"
                      id="{{ $inv->type() . $inv->getID() }}">
                      <th>{{ $loop->index + 1 }}</th>
                      <td class="text-start">{{ $inv->nombre() }}</td>
                      <td>
                        <a
                          href="{{ route('edit-inv', ['id_element' => $inv->getID(), 'id_belong' => $subsection->getID()]) }}">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </td>
                      <td>
                        <button class="btn-vacio" data-bs-toggle="modal"
                          data-bs-target="#modalDelete{{ $inv->type() . $inv->getID() }}">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              {{-- MODAL DELETE INV --}}
              @foreach ($subsection->invs as $inv)
                @include('inc.modal-delete', ['element' => $inv])
              @endforeach
            </div>
          </td>
        </tr>
      @endif
    @endforeach
  </tbody>
</table>