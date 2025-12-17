<nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3">
  <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
    <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
      <a href="{{ url('/') }}"
        class="text-white text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase">
        SIMBARANG
      </a>
      <button
        class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
        type="button"
        onclick="document.getElementById('authNavbar').classList.toggle('hidden')">
        <i class="text-white fas fa-bars"></i>
      </button>
    </div>

    <div class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none hidden rounded shadow-lg"
      id="authNavbar">
      <ul class="flex flex-col lg:flex-row list-none mr-auto">
        {{-- Tidak ada menu tambahan di kiri --}}
      </ul>
      <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
        <li class="flex items-center">
          <a
            href="{{ route('request-akun.form') }}"
            class="lg:text-white text-blueGray-700 px-3 py-2 text-xs uppercase font-bold hover:underline inline-flex items-center"
          >
            <i class="fas fa-user-plus mr-2 text-sm"></i>
            Permintaan Akun
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>