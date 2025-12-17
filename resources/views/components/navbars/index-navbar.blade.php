<nav x-data="{ navbarOpen: false }" class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow">
  <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
    <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
      <a
        href="/"
        class="text-blueGray-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
      >
        SIMBARANG
      </a>
      <button
        class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
        type="button"
        @click="navbarOpen = !navbarOpen"
      >
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <div
      class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none"
      :class="{ 'block': navbarOpen, 'hidden': !navbarOpen }"
      id="example-navbar-warning"
    >
    <ul class="flex flex-col lg:flex-row list-none mr-auto">
        <li class="flex items-center">
          <a
            class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
            href="#tentang-samsat"
          >
            <i class="text-blueGray-400 fas fa-info-circle text-lg leading-lg mr-2"></i>
            Tentang
          </a>
        </li>
      </ul>
    <!-- <ul class="flex flex-col lg:flex-row list-none mr-auto">
      <li class="flex items-center">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="#"
        >
          <i class="text-blueGray-400 fas fa-user-plus text-lg leading-lg mr-2"></i>
          Permintaan Akun
        </a>
      </li>
    </ul> -->

      <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
        <li class="flex items-center">
          <a
            class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
            href="{{ route('login') }}"
          >
            <i class="text-blueGray-400 fas fa-sign-in-alt text-lg leading-lg mr-2"></i>
            Masuk Sistem
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
