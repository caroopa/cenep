@extends('layouts.app')

@section('content')
  <section class="pasador" style="background-image: url({{ asset('img/index/' . $page->imagen) }});">
    <div class="titulos">{!! $page->titulo !!}</div>
  </section>

  <section class="division-section">
    <div class="presentacion-container">
      <p>{!! $page->presentacion !!}</p>
    </div>
  </section>

  <section class="division-section">
    <div class="novedades">
      <div class="encabezado-separador">
        <h1>Novedades</h1>
      </div>
      <a class="twitter-timeline" data-lang="es" data-width="750" data-height="500"
        href="https://twitter.com/CENEParg?ref_src=twsrc%5Etfw">Tweets by CENEParg</a>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
  </section>

  <section class="division-section"></section>
@endsection
