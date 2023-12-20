@extends('layouts.app')

@section('content-section')
  <div class="encabezado-separador">
    <h1>{{ $subsection->nombre }}</h1>
  </div>
  <div class="texto">
    @if ($subsection->tipo == 'article')
      {!! $subsection->descripcion !!}
      @if (!empty($subsection->articles))
        <h3>{{ $subsection->subtitulo }}</h3>
        <ul>
          @foreach ($subsection->articles as $article)
            @if ($article->withoutLink())
              <li>{{ $article->titulo }}</li>
            @else
              <li><a href="{{ route('article', ['id_article' => $article->id_articulo]) }}"> {{ $article->titulo }} </a>
              </li>
            @endif
          @endforeach
        </ul>
      @endif
      <h3>Publicaciones</h3>
      {!! $subsection->publicaciones !!}
    @elseif ($subsection->tipo == 'inv')
      @foreach ($subsection->invs as $inv)
        @if ($inv->withoutLink())
          <p>{{ $inv->nombre }}</p>
        @else
          <p><a href="{{ route('inv', ['id_inv' => $inv->id_investigador]) }}"> {{ $inv->nombre }} </a></p>
        @endif
      @endforeach
    @else
      {!! $subsection->contenido !!}
    @endif
  </div>
@endsection

@section('content')
  @include('layouts.main') {{-- Incluye la plantilla interna --}}
@endsection
