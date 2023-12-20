<section class="body mx-auto">
  <div class="contenedor-body row">
    @include('inc.menu', ['section' => $section]) {{-- Incluye el menú --}}

    <div class="body-texto col-md-9 p-5">
      @yield('content-section') {{-- Contenido de la página específica --}}
    </div>
  </div>
</section>