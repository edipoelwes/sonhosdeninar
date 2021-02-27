<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  @include('layout.components.links')

  <title>@yield('title')</title>

  @stack('styles')
</head>

<body>
  
  @include('sweetalert::alert')

  <div class="wrapper ">

    @include('layout.components.sidebar')

    <div class="main-panel">
      <!-- Navbar -->
      @include('layout.components.navbar')
      <!-- End Navbar -->
      <div class="content">
        @yield('content')
      </div>

      <footer class="footer footer-black  footer-white ">
        @include('layout.components.footer')
      </footer>
    </div>
  </div>

  @include('layout.components.scripts')

  @stack('js')
</body>

</html>
