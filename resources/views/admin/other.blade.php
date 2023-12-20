@extends('layouts.admin')

@section('content-admin')
  <div class="encabezado-separador-admin">
    <h1>Elementos sin pertenencia</h1>
  </div>
  <p>Estos son los elementos que no están vinculados a ninguna parte, ya sea por la eliminación de su sección/subsección o
    por algún otro motivo. Acá se podrá redefinir su pertenencia o eliminarlos definitivamente.</p>

  @if (!$subsections->isEmpty())
    <div class="admin-other-container">
      <h2>Subsecciones</h2>
      @include('inc.table-crud', ['elements' => $subsections])
      @foreach ($subsections as $subsection)
        @include('inc.modal-edit', ['element' => $subsection, 'parent' => $sections])
        @include('inc.modal-delete', ['element' => $subsection])
      @endforeach
    </div>
  @endif
  @if (!$articles->isEmpty())
    <div class="admin-other-container">
      <h2>Artículos</h2>
      @include('inc.table-crud', ['elements' => $articles])
      @foreach ($articles as $article)
        @include('inc.modal-edit', ['element' => $article, 'parent' => $allSubsections])
        @include('inc.modal-delete', ['element' => $article])
      @endforeach
    </div>
  @endif
  @if (!$invs->isEmpty())
    <div class="admin-other-container">
      <h2>Investigadores/as</h2>
      @include('inc.table-crud', ['elements' => $invs])
      @foreach ($invs as $inv)
        @include('inc.modal-edit', ['element' => $inv, 'parent' => $allSubsections])
        @include('inc.modal-delete', ['element' => $inv])
      @endforeach
    </div>
  @endif

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
@endsection
