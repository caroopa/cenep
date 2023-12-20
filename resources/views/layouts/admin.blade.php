@include('inc.links')

<body>
  @include('inc.header-admin')

  <section class="editor-container container">
    @yield('content-admin')
  </section>

  @include('inc.footer')
</body>

<script>
  const btnCollapse = document.querySelectorAll(".btn-collapse");
  btnCollapse.forEach((element) => {
    element.addEventListener("click", function() {
      if (element.getAttribute('aria-expanded') == "true") {
        element.innerHTML = "<i class='fa-solid fa-chevron-up'></i>";
      } else {
        element.innerHTML = "<i class='fa-solid fa-chevron-down'></i>";
      }
    });
  });
</script>

@include('inc.scripts')
