<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="Masukkan Email Anda"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />
            <x-text-input id="password" class="block mt-1 w-full" placeholder="Masukkan password Anda" type="password"
                name="password" required autocomplete="current-password" />
            <div class="mt-1 flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="show-password"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="show-password" class="ms-2 text-sm text-gray-600">{{ __('Tampilkan Password') }}</label>
                </div>
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
        <p class="text-center text-gray-600 text-sm mt-4">Belum punya akun? <a href="{{ route('register') }}"
                class="text-blue-600 hover:underline">Daftar</a></p>
    </form>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle visibility for password
            const showPasswordCheckbox = document.getElementById("show-password");
            const passwordInput = document.getElementById("password");

            showPasswordCheckbox.addEventListener("change", function() {
                passwordInput.type = this.checked ? "text" : "password";
            });

            // Check for login error messages
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            @endif

            @if (session('inactive'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Akun Tidak Aktif',
                    text: '{{ session('inactive') }}',
                });
            @endif
        });
    </script>
</x-guest-layout>
