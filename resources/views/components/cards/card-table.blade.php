{{-- resources/views/components/cards/card-table.blade.php --}}
@props(['title' => 'Judul Tabel'])

<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
  <div class="rounded-t mb-0 px-4 py-3 border-0 bg-blueGray-50">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
        <h3 class="font-semibold text-base text-blueGray-700">{{ $title }}</h3>
      </div>
    </div>
  </div>
  <div class="block w-full overflow-x-auto rounded-t border-b border-blueGray-100">
    <table class="items-center w-full bg-transparent border-collapse">
      {{ $slot }}
    </table>
  </div>
</div>
