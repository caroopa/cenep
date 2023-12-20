@extends('layouts.app')

@section('content-section')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="no-activo"
          href="{{ route('subsection', ['id_subsection' => $subsection->id_subseccion]) }}">{{ $subsection->nombre }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $article->titulo_corto }}</li>
    </ol>
  </nav>

  <div class="encabezado-separador">
    <h1>{{ $article->titulo }}</h1>
  </div>

  <div class="texto">{!! $article->contenido !!}</div>
@endsection

@section('content')
  @include('layouts.main') {{-- Incluye la plantilla interna --}}
@endsection
