<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIMBARANG - Admin Panel</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blueGray-100 text-blueGray-700 antialiased">

  {{-- Sidebar --}}
    @if (auth()->user()->role === 'admin')
        <x-sidebar.admin-sidebar />
    {{-- @else
        <x-sidebars.staff-sidebar /> --}}
    @endif

  <div class="relative md:ml-64 bg-blueGray-100">
    
    {{-- Navbar --}}
    <x-navbars.admin />

    {{-- Header --}}
    @hasSection('header')
      @yield('header')
    @endif
    
    {{-- Konten dinamis --}}
    <div class="px-4 md:px-10 mx-auto w-full -m-24">
      @yield('admin-content')

      {{-- Footer --}}
      <x-footers.footer-admin />
    </div>

  </div>
</body>
</html>
