<div x-data="{ open: false }" class="relative">
  {{-- Trigger Dropdown --}}
  <button @click="open = !open" class="text-blueGray-500 block focus:outline-none">
    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow">
      <i class="fas fa-user text-blueGray-600 text-lg"></i>
    </div>
  </button>

  {{-- Dropdown Menu --}}
  <div x-show="open" @click.away="open = false"
       class="absolute right-0 mt-2 z-50 bg-white rounded shadow-lg py-2 text-sm w-40">
    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-blueGray-700 hover:bg-blueGray-100">
      <i class="fas fa-user-circle mr-2"></i> Profil
    </a>
    <a href="{{ route('logout') }}"
       class="block px-4 py-2 text-blueGray-700 hover:bg-blueGray-100"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
  </div>
</div>
