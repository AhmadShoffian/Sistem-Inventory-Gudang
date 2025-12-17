<!DOCTYPE html>
<html lang="en" class="h-full">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>SIMBARANG - Permintaan Akun</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    @vite('resources/css/app.css')
  </head>
  <body class="h-full text-blueGray-700 antialiased">

    {{-- Navbar request akun --}}
    @include('components.navbars.request')

    <main>
      <section class="relative w-full h-full min-h-screen ">
        <div
          class="absolute top-0 w-full h-full bg-blueGray-800 bg-no-repeat bg-cover z-0"
            style="background-image: url('{{ asset('img/register_bg_2.png') }}'); background-size: cover; background-position: top center;">
        </div>

        <div class="relative z-10 pt-10 pb-20">
          @yield('auth-content')
        </div>

        @include('components.footers.footer-small', ['absolute' => true])
      </section>
    </main>
  </body>
</html>
