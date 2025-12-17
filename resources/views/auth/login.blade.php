{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.auth')

@section('auth-content')
<div class="container mx-auto px-4 h-full">
  <div class="flex content-center items-center justify-center h-full">
    <div class="w-full lg:w-4/12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
        <div class="rounded-t mb-0 px-6 py-2">
        <div class="text-center mb-1 pt-4">
          {{-- Logo --}}
          <img
            src="{{ asset('img/logo-samsat.png') }}"
            alt="Logo SAMSAT"
            class="mx-auto mb-4 h-16 w-auto"
          />
          {{-- Judul --}}
          <h6 class="text-blueGray-500 text-sm font-bold">
            SIMBARANG SAMSAT KAPUAS
          </h6>
        </div>
        </div>
        <div class="flex-auto px-4 lg:px-10 pt-4 pb-8">
          <div class="text-blueGray-400 text-center mb-6 font-bold">
            <small> Silakan login menggunakan NIP dan Password Anda untuk mengakses sistem.</small>
          </div>

          @if(session('error'))
            <p class="text-red-500 text-sm mb-4 animate-fade-in" id="login-error">
              {{ session('error') }}
            </p>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                NIP
              </label>
              <input
                type="text"
                name="nip"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                placeholder="NIP"
                required
                autofocus
              />
            </div>
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                Password
              </label>
              <div class="relative">
                <input
                  id="password"
                  type="password"
                  name="password"
                  class="border-0 px-3 py-3 pr-10 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  required
                  autocomplete="current-password"
                />
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-blueGray-400 hover:text-blueGray-600 focus:outline-none">
                  <i id="eye-icon" class="fas fa-eye"></i>
                </button>
              </div>
            </div>
            <!-- <div>
              <label class="inline-flex items-center cursor-pointer">
                <input
                  type="checkbox"
                  name="remember"
                  class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                />
                <span class="ml-2 text-sm font-semibold text-blueGray-600">
                  Ingat saya
                </span>
              </label>
            </div> -->
            <div class="text-center mt-6">
              <button
                type="submit"
                class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none w-full ease-linear transition-all duration-150"
              >
                Masuk
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }

  // auto dismiss alert login error
  const errorMsg = document.getElementById('login-error');
  if (errorMsg) {
    setTimeout(() => {
      errorMsg.style.transition = 'opacity 0.5s ease';
      errorMsg.style.opacity = 0;
    }, 3000); // hilang setelah 3 detik
  }
</script>

@endsection
