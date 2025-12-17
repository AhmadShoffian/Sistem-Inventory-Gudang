<div x-data="{ collapseShow: false }">
  <nav class="md:left-0 md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-50 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">

      {{-- Toggler --}}
      <button
        class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
        @click="collapseShow = !collapseShow"
      >
        <template x-if="!collapseShow">
          <i class="fas fa-bars"></i>
        </template>
        <template x-if="collapseShow">
          <i class="fas fa-times"></i>
        </template>
      </button>

      {{-- Brand --}}
      <a href="{{ url('/') }}" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
        SIMBARANG
      </a>

      {{-- Collapse --}}
      <div
        :class="collapseShow ? 'block bg-white m-2 py-3 px-6' : 'hidden'"
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-80 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
      >

        {{-- Collapse Header (mobile only) --}}
        <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <a href="{{ url('/') }}" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                SIMBARANG
              </a>
            </div>
            <div class="w-6/12 flex justify-end">
              <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                @click="collapseShow = false"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </div>

        {{-- Divider --}}
        <hr class="my-4 md:min-w-full" />

        {{-- Menu Section (Admin Layout Pages) --}}
        <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
          Admin Layout Pages
        </h6>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          @php
              $menus = [
                  ['label' => 'Dashboard', 'icon' => 'fas fa-tv', 'route' => 'admin/dashboard'],
                  ['label' => 'Settings', 'icon' => 'fas fa-tools', 'route' => 'admin/settings'],
                  ['label' => 'Tables', 'icon' => 'fas fa-table', 'route' => 'admin/tables'],
                  ['label' => 'Maps', 'icon' => 'fas fa-map-marked', 'route' => 'admin/maps'],
              ];
          @endphp
          @foreach ($menus as $menu)
            <li class="items-center">
              <a href="{{ url($menu['route']) }}"
                class="text-xs uppercase py-3 font-bold block {{ request()->is($menu['route']) ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                <i class="{{ $menu['icon'] }} mr-2 text-sm {{ request()->is($menu['route']) ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                {{ $menu['label'] }}
              </a>
            </li>
          @endforeach
        </ul>

        {{-- Divider + Auth Layout --}}
        <hr class="my-4 md:min-w-full" />
        <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
          Auth Layout Pages
        </h6>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
          <li>
            <a href="{{ route('login') }}" class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block">
              <i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i> Login
            </a>
          </li>
          <li>
            <a href="{{ route('register') }}" class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block">
              <i class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"></i> Register
            </a>
          </li>
        </ul>

        {{-- Optional: Tambahan No Layout / Docs Section --}}
        {{-- Bisa ditambahkan kalau perlu --}}
      </div>
    </div>
  </nav>
</div>
