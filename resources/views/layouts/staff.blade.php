<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIMBARANG - Staff Panel</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blueGray-100 text-blueGray-700 antialiased">

  {{-- Sidebar khusus Staff --}}
  <x-sidebar.staff-sidebar />

  <div class="relative md:ml-64 bg-blueGray-100">
    
    {{-- Navbar Staff --}}
    <x-navbars.staff />

    {{-- Header --}}
    @hasSection('header')
      @yield('header')
    @endif
    
    {{-- Konten dinamis --}}
    <div class="px-4 md:px-10 mx-auto w-full -m-24">
      @yield('staff-content')

      {{-- Footer --}}
      <x-footers.footer-admin />
    </div>

  </div>
  @yield('scripts')
</body>
</html>