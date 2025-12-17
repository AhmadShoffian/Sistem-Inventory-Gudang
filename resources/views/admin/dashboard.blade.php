@extends('layouts.admin')

@section('header')
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
@endsection

@section('admin-content')
<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
  <div class="rounded-t mb-0 px-4 py-3 border-0 bg-blueGray-50">
    <div class="flex items-center justify-between">
      <h3 class="font-semibold text-base text-blueGray-700">
        Permintaan Akun Terbaru
      </h3>
      <a href="{{ route('admin.request.index') }}" class="text-sm text-blue-500 hover:underline">
        Lihat Semua
      </a>
    </div>
  </div>

  <div class="block w-full overflow-x-auto">
    <table class="items-center w-full bg-transparent border-collapse">
      <thead>
        <tr>
          <th class="px-6 py-3 text-xs font-semibold text-left text-blueGray-500 bg-blueGray-100 uppercase">
            Nama
          </th>
          <th class="px-6 py-3 text-xs font-semibold text-left text-blueGray-500 bg-blueGray-100 uppercase">
            NIP
          </th>
          <th class="px-6 py-3 text-xs font-semibold text-left text-blueGray-500 bg-blueGray-100 uppercase">
            Unit Kerja
          </th>
          <th class="px-6 py-3 text-xs font-semibold text-left text-blueGray-500 bg-blueGray-100 uppercase">
            Status
          </th>
        </tr>
      </thead>
      <tbody>
        @forelse ($recentRequests as $req)
          <tr>
            <td class="px-6 py-4 text-sm text-blueGray-700">{{ $req->nama }}</td>
            <td class="px-6 py-4 text-sm">{{ $req->nip }}</td>
            <td class="px-6 py-4 text-sm">{{ $req->unit_kerja }}</td>
            <td class="px-6 py-4 text-sm capitalize">
              <span class="px-2 py-1 rounded-full text-white text-xs font-bold
                {{ $req->status === 'pending' ? 'bg-yellow-500' :
                   ($req->status === 'approved' ? 'bg-green-500' : 'bg-red-500') }}">
                {{ $req->status }}
              </span>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-center text-sm text-blueGray-400">Belum ada permintaan akun.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
