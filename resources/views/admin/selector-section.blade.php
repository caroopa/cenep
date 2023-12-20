@extends('layouts.admin')

@section('content-admin')
  <div class="section-header">
    <nav class="tabs-nav">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach ($sections as $section)
          <button class="nav-link {{ $section->id_seccion == $tab ? 'active' : '' }}"
            id="nav-{{ $section->id_seccion }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $section->id_seccion }}"
            type="button" role="tab" aria-selected={{ $section->id_seccion == $tab ? 'true' : 'false' }}>
            {{ $section->nombre }}
          </button>
        @endforeach
      </div>
    </nav>

    <a href="{{ route('add-section') }}">
      <button class="btn-vacio"><i class="fa-solid fa-circle-plus"></i></button>
    </a>
  </div>
  <div class="tab-content" id="nav-tabContent">
    @foreach ($sections as $section)
      <div class="tab-pane fade {{ $section->id_seccion == $tab ? 'show active' : '' }}"
        id="nav-{{ $section->id_seccion }}" role="tabpanel">
        <div class="encabezado-separador-tables">
          <div class="section-name">

            <h1>{{ $section->nombre }}</h1>
            <a href="{{ route('edit-section', ['id_element' => $section->getID()]) }}">
              <i class="fa-solid fa-pen"></i>
            </a>
            <button class="btn-vacio" data-bs-toggle="modal"
              data-bs-target="#modalDelete{{ $section->type() . $section->getID() }}">
              <i class="fa-solid fa-trash"></i>
            </button>

          </div>
          <div class="btn-container">
            <a href="{{ route('add-subsection', ['id_belong' => $section->getID()]) }}">
              <button class="btn-add"><i class="fa-solid fa-circle-plus"></i>Agregar</button>
            </a>
          </div>
        </div>
        <div class="admin-main-container">
          @include('inc.table-crud-section', ['section' => $section])

          {{-- MODAL DELETE SUBSECTION --}}
          @foreach ($section->subsections as $subsection)
            @include('inc.modal-delete', ['element' => $subsection])
          @endforeach
        </div>
      </div>
    @endforeach
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

  {{-- MODAL DELETE SECTION --}}
  @foreach ($sections as $section)
    @include('inc.modal-delete', ['element' => $section])
  @endforeach

  @isset($new)
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const elemento = document.getElementById('{{ $new_type . $new }}');
        if (elemento) {
          elemento.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
      });
    </script>
  @endisset
@endsection
