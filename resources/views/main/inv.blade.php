@extends('layouts.app')

@section('content-section')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="no-activo"
          href="{{ route('subsection', ['id_subsection' => $subsection->id_subseccion]) }}">{{ $subsection->nombre }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $inv->nombre }}</li>
    </ol>
  </nav>

  <div class="encabezado-separador">
    <h1>{{ $inv->nombre }}</h1>
  </div>

  <div class="texto">
    <p>
      @if (!empty($inv->cv))
        <a href="{{ asset('docs/' . $inv->cv) }}" target="_blank">cv completo
      @endif
      @if (!empty($inv->cv) && !empty($inv->mail))
        <span> | </span>
      @endif
      @if (!empty($inv->mail))
        </a><a href={{ 'mailto:' . $inv->mail }}> {{ $inv->mail }} </a>
      @endif
    </p>

    <p> {!! $inv->descripcion !!} </p>

    @if ($inv->articles->count() > 0 || !empty($inv->investigaciones))
      <h3>Investigaciones</h3>
      @if ($inv->articles->count() > 0)
        <ul>
          @foreach ($inv->articles as $article)
            <li><a href="{{ route('article', ['id_article' => $article->id_articulo]) }}"> {{ $article->titulo }} </a>
            </li>
          @endforeach
        </ul>
      @endif
      @if (!empty($inv->investigaciones))
        {!! $inv->investigaciones !!}
      @endif
    @endif

    @if (!empty($inv->publicaciones))
      <h3>Publicaciones</h3>
      {!! $inv->publicaciones !!}
    @endif
  </div>
@endsection

@section('content')
  @include('layouts.main') {{-- Incluye la plantilla interna --}}
@endsection
