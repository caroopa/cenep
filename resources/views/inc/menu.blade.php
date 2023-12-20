<div class="menu-sec col-md-3 p-5">
  <div class="contenedor-menu">
    <div class="encabezado-menu">
      <h1>{{ $section->nombre }}</h1>
    </div>
    <ul class="lista-menu">
      @foreach ($section->subsections as $subsection)
        <a href="{{ route('subsection', ['id_subsection' => $subsection->id_subseccion]) }}">
          <li>{{ $subsection->nombre }}</li>
        </a>
      @endforeach
    </ul>
  </div>
</div>
