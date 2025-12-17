<!DOCTYPE html>
<html lang="en" class="h-full">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMBARANG - Login</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    @vite('resources/css/app.css')
  </head>
  <body class="h-full text-blueGray-700 antialiased">
    @include('components.navbars.auth', ['transparent' => true])

    <main>
      <section class="relative w-full h-full py-40 min-h-screen">
        <div
          class="absolute top-0 w-full h-full bg-blueGray-800 bg-no-repeat bg-cover z-0"
          style="background-image: url('{{ asset('img/register_bg_2.png') }}');"
        ></div>

        <div class="relative z-10">
          @yield('auth-content')
        </div>

        @include('components.footers.footer-small', ['absolute' => true])
      </section>
    </main>
  </body>
</html>
