<div x-data="{ open: false }" class="relative">
  <a href="#" @click.prevent="open = !open"
     class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold">
    Demo Pages
  </a>

  <div x-show="open" @click.away="open = false"
       class="absolute z-50 bg-white text-base float-left py-2 list-none text-left rounded shadow-lg min-w-48">
    <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">Admin Layout</span>
    <a href="/admin/dashboard" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Dashboard</a>
    <a href="/admin/settings" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Settings</a>
    <a href="/admin/tables" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Tables</a>
    <a href="/admin/maps" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Maps</a>

    <div class="h-px mx-4 my-2 bg-blueGray-100"></div>

    <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">Auth Layout</span>
    <a href="/auth/login" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Login</a>
    <a href="/auth/register" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Register</a>

    <div class="h-px mx-4 my-2 bg-blueGray-100"></div>

    <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">No Layout</span>
    <a href="/landing" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Landing</a>
    <a href="/profile" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100">Profile</a>
  </div>
</div>