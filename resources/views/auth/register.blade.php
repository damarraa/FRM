<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Registrasi Berhasil!",
                        text: "Akun Anda telah berhasil dibuat, mohon tunggu konfirmasi Admin.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="'Nama'" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="no_hp" :value="'No Handphone'" />
            <x-text-input id="no_hp" class="block mt-1 w-full no-spinner" type="number" name="no_hp"
                :value="old('no_hp')" required autocomplete="tel" inputmode="numeric" placeholder="081234567890" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />
            <div class="relative">
                <x-text-input id="password" class="block w-full" type="password" name="password" required
                    autocomplete="new-password" placeholder="Minimal 8 karakter" />
            </div>
            <div class="mt-1 flex items-center">
                <input type="checkbox" id="show-password"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="show-password" class="ms-2 text-sm text-gray-600">Tampilkan Password</label>
            </div>
            <span id="password-error" class="text-red-500 text-sm" style="color: red"></span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Ketik ulang password Anda" />
            </div>
            <div class="mt-1 flex items-center">
                <input type="checkbox" id="show-confirm-password"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="show-confirm-password" class="ms-2 text-sm text-gray-600">Tampilkan Password</label>
            </div>
            <span id="confirm-password-error" class="text-red-500 text-sm mt-1" style="color: red"></span>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Signature -->
        <div class="mt-4">
            <x-input-label for="signature" :value="'Tanda Tangan'" />
            <div class="relative">
                <button id="open-signature-modal" type="button"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                    </svg>
                    <span>Tambahkan Tanda Tangan</span>
                </button>
            </div>
            <input type="hidden" name="signature" id="signature">
            <div id="signature-preview" class="mt-2 hidden">
                <p class="text-sm text-gray-600 mb-1">Pratinjau Tanda Tangan:</p>
                <img id="signature-image" class="border border-gray-300 rounded-lg w-full max-h-32 object-contain" />
                <button type="button" id="remove-signature" class="mt-2 text-sm text-red-600 hover:text-red-800">
                    Hapus Tanda Tangan
                </button>
            </div>
            <x-input-error :messages="$errors->get('signature')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Modal untuk Tanda Tangan -->
    <div id="signature-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-full md:w-3/4 lg:w-1/3 mx-4 max-w-2xl">
            <h2 class="text-xl font-bold mb-4">Tanda Tangan</h2>
            <div style="position: relative; width: 100%; padding-top: 60%;">
                <canvas id="signatureCanvas" class="absolute inset-0 w-full h-full"
                    style="border: 1px solid #000;"></canvas>
            </div>
            <div class="mt-4">
                <button type="button" id="clear-signature" class="bg-red-500 text-black px-4 py-2 rounded">
                    Hapus
                </button>
                <button type="button" id="save-signature" class="bg-blue-500 text-black px-4 py-2 rounded ml-2">
                    Selesai
                </button>
            </div>
        </div>
    </div>
</x-guest-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
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

<script>
    // Inisialisasi modal
    const modal = document.getElementById('signature-modal');
    const openModalButton = document.getElementById('open-signature-modal');
    const closeModalButton = document.getElementById('save-signature');

    // Buka modal
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        resizeCanvas(); // Sesuaikan ukuran canvas saat modal dibuka
    });

    // Tutup modal
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Inisialisasi SignaturePad
    const canvas = document.getElementById('signatureCanvas');
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'white',
        penColor: 'black'
    });

    // Hapus tanda tangan
    document.getElementById('clear-signature').addEventListener('click', () => {
        signaturePad.clear();
    });

    // Simpan tanda tangan
    document.getElementById('save-signature').addEventListener('click', () => {
        if (!signaturePad.isEmpty()) {
            const dataURL = signaturePad.toDataURL('image/png');
            document.getElementById('signature').value = dataURL;
            document.getElementById('signature-image').src = dataURL;
            document.getElementById('signature-image').style.display = 'block';
            modal.classList.add('hidden'); // Tutup modal setelah menyimpan
        } else {
            alert('Tanda tangan masih kosong!');
        }
    });

    // Fungsi untuk menyesuaikan ukuran canvas
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear(); // Bersihkan canvas setelah resize
    }

    // Panggil fungsi resize saat window di-resize
    window.addEventListener('resize', resizeCanvas);
</script>
