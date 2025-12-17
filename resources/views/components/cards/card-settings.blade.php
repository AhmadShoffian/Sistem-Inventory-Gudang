<div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
  <div class="rounded-t bg-white mb-0 px-6 py-6 border-b border-blueGray-200">
    @php
      $dashboardRoute = auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard');
    @endphp

    <div class="flex items-center justify-between">
      <h6 class="text-blueGray-700 text-xl font-bold">Edit Profil</h6>
      <a href="{{ $dashboardRoute }}"
        class="text-sm text-white bg-lightBlue-500 hover:bg-lightBlue-600 font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md transition duration-150">
        ← Kembali
      </a>
    </div>
  </div>
  <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')

      <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">Informasi Akun</h6>
      <div class="flex flex-wrap">
        {{-- Nama --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring" />
              @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
        </div>

        {{-- NIP --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $user->nip) }}" required
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring" />
              @error('nip')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
        </div>

        {{-- Email --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring" />
              @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
        </div>

        {{-- Jabatan --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}"
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring" />
              @error('jabatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
        </div>

        {{-- Instansi --}}
        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Instansi</label>
            <select name="instansi" required
              class="border-0 px-3 py-3 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full transition-all duration-150">
              <option value="">-- Pilih Instansi --</option>
              <option value="UPTPPD Kalimantan Tengah" {{ $user->instansi === 'UPTPPD Kalimantan Tengah' ? 'selected' : '' }}>UPTPPD Kalimantan Tengah</option>
              <option value="POLRI" {{ $user->instansi === 'POLRI' ? 'selected' : '' }}>POLRI</option>
              <option value="Jasaraharja" {{ $user->instansi === 'Jasaraharja' ? 'selected' : '' }}>Jasaraharja</option>
            </select>
          </div>
        </div>
      </div>

      <hr class="mt-6 border-b-1 border-blueGray-300" />

      <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">Ubah Password</h6>
      <div class="flex flex-wrap">
        {{-- Password Baru --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Password Baru</label>
            <div class="relative">
              <input
                type="password"
                id="password"
                name="password"
                class="border-0 px-3 py-3 pr-10 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring transition-opacity duration-200"
              />
              <span onclick="togglePassword('password', 'eye-icon')" class="absolute inset-y-0 right-3 flex items-center text-blueGray-400 cursor-pointer">
                <i id="eye-icon" class="fas fa-eye"></i>
              </span>
            </div>
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Konfirmasi Password</label>
            <div class="relative">
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="border-0 px-3 py-3 pr-10 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow w-full focus:outline-none focus:ring transition-opacity duration-200"
              />
              <span onclick="togglePassword('password_confirmation', 'eye-icon-confirm')" class="absolute inset-y-0 right-3 flex items-center text-blueGray-400 cursor-pointer">
                <i id="eye-icon-confirm" class="fas fa-eye"></i>
              </span>
            </div>
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit"
          class="bg-lightBlue-500 text-white font-bold uppercase text-xs px-6 py-3 rounded shadow hover:shadow-md focus:outline-none transition duration-150">
          Simpan Perubahan
        </button>
      </div>
    </form>
    <script>
      function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        // Animasi keluar dulu
        input.classList.add('opacity-0');
        setTimeout(() => {
          // Ganti tipe input
          if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
          } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
          }

          // Animasi masuk
          input.classList.remove('opacity-0');
          input.classList.add('opacity-100');
        }, 150);
      }
    </script>
  </div>
</div>