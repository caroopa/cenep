@include('inc.links')

<body>
  @include('inc.header')

  <div class="content">
    @yield('content')
  </div>

  @include('inc.footer')
</body>

@include('inc.scripts')
