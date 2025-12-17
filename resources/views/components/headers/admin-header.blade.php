<div class="relative bg-lightBlue-600 md:pt-32 pb-32 pt-12">
  <div class="px-4 md:px-10 mx-auto w-full">
    <div class="flex flex-wrap">

      {{-- Card 1: Permintaan Masuk --}}
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <x-cards.card-stats
          stat-subtitle="Permintaan Masuk"
          stat-title="{{ $jumlahRequestPending }}"
          stat-icon-name="fas fa-user-clock"
          stat-icon-color="bg-emerald-500"
          stat-arrow="up"
          stat-percent-color="text-emerald-500"
          stat-descripiron="Status pending"
        />
      </div>

      {{-- Card 2: Disetujui --}}
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <x-cards.card-stats
          stat-subtitle="Permintaan Disetujui"
          stat-title="{{ $jumlahRequestApproved }}"
          stat-icon-name="fas fa-check-circle"
          stat-icon-color="bg-blue-500"
          stat-arrow="up"
          stat-percent-color="text-blue-500"
          stat-descripiron="Status approved"
        />
      </div>

      {{-- Card 3: Ditolak --}}
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <x-cards.card-stats
          stat-subtitle="Permintaan Ditolak"
          stat-title="{{ $jumlahRequestRejected }}"
          stat-icon-name="fas fa-times-circle"
          stat-icon-color="bg-red-500"
          stat-arrow="down"
          stat-percent-color="text-red-500"
          stat-descripiron="Status rejected"
        />
      </div>

      {{-- Card 4: Total Staff --}}
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <x-cards.card-stats
          stat-subtitle="Total Staff"
          stat-title="{{ $jumlahStaff }}"
          stat-icon-name="fas fa-users"
          stat-icon-color="bg-indigo-500"
          stat-arrow="up"
          stat-percent-color="text-indigo-500"
          stat-descripiron="Akun terdaftar"
        />
      </div>

    </div>
  </div>
</div>
