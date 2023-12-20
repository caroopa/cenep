<div class="logo-container">
  <a href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" class="img100"></a>
</div>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        @foreach ($sections as $section)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{ $section->nombre }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($section->subsections as $subsection)
                <a class="dropdown-item"
                  href="{{ route('subsection', ['id_subsection' => $subsection->id_subseccion]) }}">
                  {{ $subsection->nombre }}
                </a>
              @endforeach
            </div>
          </li>
        @endforeach

      </ul>
    </div>
  </div>
</nav>
