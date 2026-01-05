<div x-data="{ collapseShow: false }">
    <nav
        class="md:left-0 md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">

            {{-- Toggler --}}
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                @click="collapseShow = !collapseShow">
                <template x-if="!collapseShow">
                    <i class="fas fa-bars"></i>
                </template>
                <template x-if="collapseShow">
                    <i class="fas fa-times"></i>
                </template>
            </button>

            {{-- Brand --}}
            <a href="{{ route('staff.dashboard') }}"
                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                SIMBARANG
            </a>

            {{-- Collapse --}}
            <div :class="collapseShow ? 'block bg-white m-2 py-3 px-6' : 'hidden'"
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded">

                {{-- Collapse Header (mobile only) --}}
                <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <a href="{{ route('staff.dashboard') }}"
                                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                                SIMBARANG
                            </a>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                @click="collapseShow = false">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="mt-2 mb-1 md:min-w-full" />

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">

                    {{-- Dashboard --}}
                    <li class="items-center">
                        <a href="{{ route('staff.dashboard') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.dashboard') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-tv mr-2 text-sm {{ request()->routeIs('staff.dashboard') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Dashboard
                        </a>
                    </li>

                    {{-- === Pengadaan Habis Pakai === --}}
                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block mt-6 mb-2 px-4">
                        MASTER DATA
                    </h6>

                    {{-- Barang --}}
                    <li class="items-center">
                        <a href="{{ route('staff.barang.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.barang.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-box mr-2 text-sm {{ request()->routeIs('staff.barang.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Barang
                        </a>
                    </li>

                    <li class="items-center">
                        <a href="{{ route('staff.kategori.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.kategori.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-shopping-cart mr-2 text-sm {{ request()->routeIs('staff.kategori.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Kategori Barang
                        </a>
                    </li>

                    <li class="items-center">
                        <a href="{{ route('staff.satuan.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.satuan.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-shopping-cart mr-2 text-sm {{ request()->routeIs('staff.satuan.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Satuan Barang
                        </a>
                    </li>
                        {{-- Lokasi Barang --}}
                    <li class="items-center">
                        <a href="{{ route('staff.lokasi.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.lokasi.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-shopping-cart mr-2 text-sm {{ request()->routeIs('staff.lokasi.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Lokasi Barang
                        </a>
                    </li>

                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block mt-6 mb-2 px-4">
                        PERUSAHAAN
                    </h6>

                    {{-- Supplier --}}
                    <li class="items-center">
                        <a href="{{ route('staff.supplier.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.supplier.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-box mr-2 text-sm {{ request()->routeIs('staff.supplier.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Supplier
                        </a>
                    </li>

                    {{-- Customer --}}
                    <li class="items-center">
                        <a href="{{ route('staff.customer.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.customer.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i class="fas fa-box mr-2 text-sm {{ request()->routeIs('staff.customer.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Customer
                        </a>
                    </li>

                    {{-- <li class="items-center">
            <a href="{{ route('staff.report.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.report.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-receipt mr-2 text-sm {{ request()->routeIs('staff.report.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Laporan Pengadaan
            </a>
          </li> --}}

                    {{-- === Sensus Aset Tetap === --}}
                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block mt-6 mb-2 px-4">
                        TRANSAKSI
                    </h6>

                    {{-- Peminjaman Barang --}}
                    <li class="items-center">
                        <a href="{{ route('staff.pinjam_barang.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.pinjam_barang.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-box mr-2 text-sm {{ request()->routeIs('staff.pinjam_barang.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Barang Masuk
                        </a>
                    </li>
                    
                    {{-- Pengembalian Barang --}}
                    <li class="items-center">
                        <a href="{{ route('staff.bali_barang.index') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.bali_barang.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-box mr-2 text-sm {{ request()->routeIs('staff.bali_barang.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Barang Keluar
                        </a>
                    </li>
                    {{-- Inventaris Aset --}}
                    {{-- <li class="items-center">
            <a href="{{ route('staff.aset.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.aset.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-box-open mr-2 text-sm {{ request()->routeIs('staff.aset.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Inventaris Aset
            </a>
          </li> --}}

                    {{-- Kerusakan --}}
                    {{-- <li class="items-center">
            <a href="{{ route('staff.kerusakan.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.kerusakan.index') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-exclamation-triangle mr-2 text-sm {{ request()->routeIs('staff.kerusakan.index') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Kerusakan
            </a>
          </li> --}}

                    {{-- === SECTION: NOTICE PAJAK === --}}
                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block mt-6 mb-2 px-4">
                        Notice Pajak
                    </h6>

                    {{-- Kotak SKPD --}}
                    {{-- <li class="items-center">
            <a href="{{ route('staff.skpd.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.skpd.*') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-archive mr-2 text-sm {{ request()->routeIs('staff.skpd.*') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Inventaris SKPD
            </a>
          </li> --}}

                    {{-- Laporan Harian --}}
                    {{-- <li class="items-center">
            <a href="{{ route('staff.laporan-skpd.index') }}"
              class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('staff.laporan-skpd.*') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
              <i class="fas fa-calendar-check mr-2 text-sm {{ request()->routeIs('staff.laporan-skpd.*') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
              Laporan Harian
            </a>
          </li> --}}

                    {{-- === SECTION: LAINNYA === --}}
                    <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block mt-6 mb-2 px-4">
                        Akun
                    </h6>

                    {{-- Profil --}}
                    <li class="items-center">
                        <a href="{{ route('profile.edit') }}"
                            class="text-xs uppercase py-3 font-bold block {{ request()->routeIs('profile.edit') ? 'text-lightBlue-500 hover:text-lightBlue-600' : 'text-blueGray-700 hover:text-blueGray-500' }}">
                            <i
                                class="fas fa-user mr-2 text-sm {{ request()->routeIs('profile.edit') ? 'opacity-75' : 'text-blueGray-300' }}"></i>
                            Profil
                        </a>
                    </li>

                    {{-- Keluar --}}
                    <li class="items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-xs uppercase py-3 font-bold block w-full text-left text-blueGray-700 hover:text-red-500">
                                <i class="fas fa-sign-out-alt mr-2 text-sm text-blueGray-300"></i>
                                Keluar
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>
