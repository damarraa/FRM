<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link reset password untuk memilih password baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 p-4 bg-blue-100 text-blue-700 rounded" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'Email'" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" 
                    :value="old('email')" required autofocus placeholder="masukkan email Anda" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                 
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>