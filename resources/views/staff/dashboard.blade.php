@extends('layouts.staff')

@section('header')
@php
  date_default_timezone_set('Asia/Jakarta');
  $hour = (int) date('H');
  if ($hour >= 5 && $hour < 11) {
    $greeting = '☀️ Selamat pagi! Semoga harimu penuh semangat!';
  } elseif ($hour >= 11 && $hour < 15) {
    $greeting = '🍛 Selamat siang! Jangan lupa makan siang ya~';
  } elseif ($hour >= 15 && $hour < 18) {
    $greeting = '🌇 Selamat sore! Tetap produktif yaa';
  } else {
    $greeting = '🌙 Selamat malam! Jangan lupa istirahat ya 💫';
  }

  use Illuminate\Support\Str;
  $emoji = Str::substr($greeting, 0, 2);
  $greetingText = Str::substr($greeting, 2);
@endphp
<div class="relative bg-lightBlue-600 md:pt-28 pb-32 pt-24">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 md:px-10 max-w-screen-xl mx-auto">
    <div class="col-span-1 md:col-span-2">
      <div class="bg-white shadow-lg rounded-lg px-4 py-4">
        <div class="flex items-start gap-3">
          <div class="text-xl pt-1">{{ $emoji }}</div>
          <div>
            <h3 class="text-blueGray-700 text-lg font-semibold leading-snug">
              {{ $greetingText }}
            </h3>
            <p class="text-sm text-blueGray-500 mt-1">
              Gunakan menu di sidebar untuk mengelola data 📦🧾
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('staff-content')
<div class="px-4 md:px-10 mx-auto w-full mt-10 max-w-screen-xl">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-24">
    {{-- Card 1 --}}
    <x-cards.card-stats
      stat-subtitle="Total Barang"
      stat-title="{{ $totalBarang }}"
      stat-icon-name="fas fa-boxes"
      stat-icon-color="bg-blueGray-600"
      stat-arrow="up"
      stat-percent-color="text-blueGray-600"
      stat-description="Semua jenis barang"
    />
    {{-- Card 2 --}}
    <x-cards.card-stats
      stat-subtitle="Barang Rusak"
      stat-title=""
      stat-icon-name="fas fa-tools"
      stat-icon-color="bg-red-500"
      stat-arrow="down"
      stat-percent-color="text-red-500"
      stat-description="Perlu perbaikan"
    />
    {{-- Card 3 --}}
    <x-cards.card-stats
      stat-subtitle="Pengadaan Bulan Ini"
      stat-title="Rp 0"
      stat-icon-name="fas fa-money-bill-wave"
      stat-icon-color="bg-emerald-500"
      stat-arrow="up"
      stat-percent-color="text-emerald-500"
      stat-description="Total pengeluaran"
    />
    {{-- Card 4 --}}
    <x-cards.card-stats
      stat-subtitle="Total Notice Pajak"
      stat-title="0 lembar"
      stat-icon-name="fas fa-file-invoice"
      stat-icon-color="bg-yellow-500"
      stat-arrow="right"
      stat-percent-color="text-yellow-500"
      stat-description="Tersedia dari semua kotak"
    />
  </div>
</div>
@endsection
