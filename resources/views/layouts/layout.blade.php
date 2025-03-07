<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Prospecto')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="icon" href="https://arguz.pe/wp-content/uploads/2024/07/cropped-arguz-favicon-iPad-32x32.png"
    sizes="32x32" />
  @yield("head")
  @vite("resources/scss/app.scss")
</head>

<body>
  <div id="app">
    <header class="container">
      <div class="row">
        <div class="col-12 text-end mt-4">
          <!-- Botón de cierre de sesión -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- Token CSRF para seguridad -->
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
          </form>
        </div>
      </div>
    </header>
    @yield('content')
  </div>
  @yield('script')
</body>

</html>
