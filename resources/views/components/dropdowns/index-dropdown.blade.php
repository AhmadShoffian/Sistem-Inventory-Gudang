@props(['align' => 'left'])

<div x-data="{ open: false }" class="relative">
    <a href="#" @click.prevent="open = !open"
       class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold">
        Demo Pages
    </a>

    <div x-show="open" @click.away="open = false"
         class="absolute z-50 mt-2 bg-white rounded shadow-lg min-w-48 text-base list-none text-left">
        <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">
            Admin Layout
        </span>
        <a href="{{ url('/admin/dashboard') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Dashboard</a>
        <a href="{{ url('/admin/settings') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Settings</a>
        <a href="{{ url('/admin/tables') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Tables</a>
        <a href="{{ url('/admin/maps') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Maps</a>

        <div class="h-px my-2 bg-blueGray-100 mx-4"></div>

        <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">
            Auth Layout
        </span>
        <a href="{{ url('/auth/login') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Login</a>
        <a href="{{ url('/auth/register') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Register</a>

        <div class="h-px my-2 bg-blueGray-100 mx-4"></div>

        <span class="text-sm pt-2 pb-0 px-4 font-bold block text-blueGray-400">
            No Layout
        </span>
        <a href="{{ url('/landing') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Landing</a>
        <a href="{{ url('/profile') }}"
           class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100">Profile</a>
    </div>
</div>