<div x-data="{ collapseShow: false }">
  <nav class="md:left-0 md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
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
      <a href="{{ route('admin.dashboard') }}" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
        SIMBARANG
      </a>

      {{-- Collapse --}}
      <div
        :class="collapseShow ? 'block bg-white m-2 py-3 px-6' : 'hidden'"
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
      >

        {{-- Collapse Header (mobile only) --}}
        <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <a href="{{ route('admin.dashboard') }}" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
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

        {{-- Menu Admin --}}
        <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
          Menu Admin
        </h6>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          {{-- Dashboard --}}
          <li class="items-center">
            <a href="{{ route('admin.dashboard') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('admin.dashboard') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-tv mr-2 text-sm {{ request()->routeIs('admin.dashboard') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Dashboard
            </a>
          </li>

          {{-- Permintaan Akun --}}
          <li class="items-center">
            <a href="{{ route('admin.request.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('admin.request.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-user-plus mr-2 text-sm {{ request()->routeIs('admin.request.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Permintaan Akun
            </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</div>
