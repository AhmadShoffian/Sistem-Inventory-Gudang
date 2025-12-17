@extends('layouts.admin')

{{-- Header --}}
@section('header')
<div class="relative bg-lightBlue-600 md:pt-32 pb-44 pt-12">
  <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-16 px-4">
    <div>
      <h2 class="text-white text-2xl md:text-3xl uppercase font-bold tracking-tight">
        Permintaan Akun Staff
      </h2>
      <p class="mt-2 md:mt-3 text-sm md:text-base leading-relaxed text-white opacity-80">
        Berikut adalah daftar pengajuan akun staff yang menunggu persetujuan admin.
      </p>
    </div>
  </div>
</div>
@endsection

{{-- Konten --}}
@section('admin-content')
<div class="px-6 -mt-32">
  {{-- Flash Message --}}
  @if (session('success'))
    <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-2 rounded mb-4 text-sm">
      {{ session('success') }}
    </div>
  @endif

  {{-- Card Table --}}
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
    <div class="rounded-t mb-0 px-4 py-3 border-0 bg-blueGray-50">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-blueGray-700">Tabel Permintaan</h3>
        </div>
      </div>
    </div>

    <div class="block w-full overflow-x-auto rounded-t border-b border-blueGray-100">
      <div class="flex flex-col md:flex-row md:justify-between items-start md:items-center gap-2 px-6 py-4">
        <form method="GET" class="flex gap-2 items-center">
          <label for="status" class="text-sm font-medium text-blueGray-600">Filter:</label>
          <select name="status" id="status" onchange="this.form.submit()"
            class="pl-4 pr-8 py-2 text-sm border border-blueGray-200 rounded-md bg-white text-blueGray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-lightBlue-500 focus:border-lightBlue-500 transition">
            <option value="">Semua</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
        </form>
        <p class="text-sm text-blueGray-500">
          Menampilkan:
          <span class="inline-block bg-blueGray-100 text-blueGray-700 font-semibold px-2 py-1 rounded text-xs capitalize">
            {{ $status ?? 'semua' }}
          </span>
        </p>
      </div>
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              Nama
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              NIP
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              Jabatan
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              Instansi
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              Email
            </th>
            <th class="px-6 py-3 text-xs font-semibold text-blueGray-500 bg-blueGray-100 uppercase border-b border-blueGray-200 text-left">
              Aksi
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($requests as $req)
            <tr class="hover:bg-blueGray-50">
              <td class="px-6 py-4 text-sm text-blueGray-700 border-t border-blueGray-100">{{ $req->nama }}</td>
              <td class="px-6 py-4 text-sm border-t border-blueGray-100">{{ $req->nip }}</td>
              <td class="px-6 py-4 text-sm border-t border-blueGray-100">{{ $req->jabatan }}</td>
              <td class="px-6 py-4 text-sm border-t border-blueGray-100">{{ $req->unit_kerja }}</td>
              <td class="px-6 py-4 text-sm border-t border-blueGray-100">{{ $req->email }}</td>
              <td class="px-6 py-4 border-t border-blueGray-100">
                @if ($req->status === 'pending')
                  <form method="POST" action="{{ route('admin.request.approve', $req->id) }}" class="inline-block">
                    @csrf
                    <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-1 px-3 rounded-full text-xs transition-all"
                      onclick="return confirm('Yakin setujui permintaan akun ini?')">Setujui</button>
                  </form>
                  <form method="POST" action="{{ route('admin.request.reject', $req->id) }}" class="inline-block">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full text-xs transition-all"
                      onclick="return confirm('Yakin tolak permintaan akun ini?')">Tolak</button>
                  </form>
                @else
                  <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                    {{ $req->status === 'approved' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                    {{ ucfirst($req->status) }}
                  </span>
                @endif
              </td>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-4 text-center text-blueGray-400 text-sm">Belum ada permintaan akun.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
