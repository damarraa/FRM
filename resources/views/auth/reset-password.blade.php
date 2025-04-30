<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <div class="mt-1 flex items-center">
                <input type="checkbox" id="show-password"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="show-password" class="ms-2 text-sm text-gray-600">Show Password</label>
            </div>
            <span id="password-error" class="text-red-500 text-sm" style="color: red"></span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <div class="mt-1 flex items-center">
                <input type="checkbox" id="show-confirm-password"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="show-confirm-password" class="ms-2 text-sm text-gray-600">Show Password</label>
            </div>
            <span id="confirm-password-error" class="text-red-500 text-sm mt-1" style="color: red"></span>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Validasi real-time password dan confirm password
        document.addEventListener("DOMContentLoaded", function() {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");
            const passwordError = document.getElementById("password-error");
            const confirmPasswordError = document.getElementById("confirm-password-error");

            function validatePassword() {
                let passwordValue = password.value;
                let confirmPasswordValue = confirmPassword.value;

                // Cek panjang password
                if (passwordValue.length < 8) {
                    passwordError.textContent = "Password harus minimal 8 karakter.";
                } else {
                    passwordError.textContent = "";
                }

                // Cek kesesuaian password dan konfirmasi password
                if (confirmPasswordValue.length > 0 && passwordValue !== confirmPasswordValue) {
                    confirmPasswordError.textContent = "Konfirmasi password tidak cocok.";
                } else {
                    confirmPasswordError.textContent = "";
                }
            }
        });

        password.addEventListener("input", validatePassword);
        confirmPassword.addEventListener("input", validatePassword);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle visibility for password and confirm password
            function togglePasswordVisibility(checkboxId, inputId) {
                const checkbox = document.getElementById(checkboxId);
                const input = document.getElementById(inputId);

                checkbox.addEventListener("change", function() {
                    input.type = this.checked ? "text" : "password";
                });
            }

            togglePasswordVisibility("show-password", "password");
            togglePasswordVisibility("show-confirm-password", "password_confirmation");

            // Password validation
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");
            const passwordError = document.getElementById("password-error");
            const confirmPasswordError = document.getElementById("confirm-password-error");

            function validatePassword() {
                const passwordValue = password.value;
                const confirmPasswordValue = confirmPassword.value;

                // Cek panjang password
                passwordError.textContent = passwordValue.length < 8 ? "Password harus minimal 8 karakter." : "";

                // Cek kesesuaian password dan konfirmasi password
                confirmPasswordError.textContent = (confirmPasswordValue.length > 0 && passwordValue !==
                        confirmPasswordValue) ?
                    "Konfirmasi password tidak cocok." :
                    "";
            }

            password.addEventListener("input", validatePassword);
            confirmPassword.addEventListener("input", validatePassword);
        });
    </script>
</x-guest-layout>
