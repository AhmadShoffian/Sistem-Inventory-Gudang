<div class="relative bg-lightBlue-600 md:pt-32 pb-32 pt-12">
  <div class="px-4 md:px-10 mx-auto w-full">
    <div class="flex flex-wrap">

      @if(Auth::user()->role === 'admin')

        {{-- ADMIN: Permintaan Masuk --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Permintaan Masuk"
            stat-title="{{ $jumlahRequestPending }}"
            stat-icon-name="fas fa-user-clock"
            stat-icon-color="bg-emerald-500"
            stat-arrow="up"
            stat-percent="100%"
            stat-percent-color="text-emerald-500"
            stat-descripiron="Status pending"
          />
        </div>

        {{-- ADMIN: Disetujui --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Permintaan Disetujui"
            stat-title="{{ $jumlahRequestApproved }}"
            stat-icon-name="fas fa-check-circle"
            stat-icon-color="bg-blue-500"
            stat-arrow="up"
            stat-percent="100%"
            stat-percent-color="text-blue-500"
            stat-descripiron="Status approved"
          />
        </div>

        {{-- ADMIN: Ditolak --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Permintaan Ditolak"
            stat-title="{{ $jumlahRequestRejected }}"
            stat-icon-name="fas fa-times-circle"
            stat-icon-color="bg-red-500"
            stat-arrow="down"
            stat-percent="100%"
            stat-percent-color="text-red-500"
            stat-descripiron="Status rejected"
          />
        </div>

        {{-- ADMIN: Total Staff --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Total Staff"
            stat-title="{{ $jumlahStaff }}"
            stat-icon-name="fas fa-users"
            stat-icon-color="bg-indigo-500"
            stat-arrow="up"
            stat-percent="100%"
            stat-percent-color="text-indigo-500"
            stat-descripiron="Akun terdaftar"
          />
        </div>

      @else

        {{-- STAFF: Placeholder Card 1 --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Aktivitas Bulan Ini"
            stat-title="24 Item"
            stat-icon-name="fas fa-box"
            stat-icon-color="bg-yellow-500"
            stat-arrow="up"
            stat-percent="+12%"
            stat-percent-color="text-emerald-500"
            stat-descripiron="Dibanding bulan lalu"
          />
        </div>

        {{-- STAFF: Placeholder Card 2 --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Kerusakan Dilaporkan"
            stat-title="5 Barang"
            stat-icon-name="fas fa-tools"
            stat-icon-color="bg-orange-500"
            stat-arrow="down"
            stat-percent="-5%"
            stat-percent-color="text-red-500"
            stat-descripiron="Minggu ini"
          />
        </div>

        {{-- STAFF: Placeholder Card 3 --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Barang Habis Pakai"
            stat-title="148"
            stat-icon-name="fas fa-clipboard-list"
            stat-icon-color="bg-pink-500"
            stat-arrow="up"
            stat-percent="+3%"
            stat-percent-color="text-emerald-500"
            stat-descripiron="Update terakhir"
          />
        </div>

        {{-- STAFF: Placeholder Card 4 --}}
        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
          <x-cards.card-stats
            stat-subtitle="Notis Pajak"
            stat-title="3 Kotak"
            stat-icon-name="fas fa-receipt"
            stat-icon-color="bg-lightBlue-500"
            stat-arrow="up"
            stat-percent="100%"
            stat-percent-color="text-indigo-500"
            stat-descripiron="Tersedia"
          />
        </div>

      @endif

    </div>
  </div>
</div>
