@extends('layouts.app')

@section('content')
  <section>
    <div class="contenedor-error">
      <h1>La página solicitada no existe.</h1>
      <p><a href="{{ route('index') }}">Volver</a></p>
    </div>
  </section>
@endsection
