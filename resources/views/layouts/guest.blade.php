<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('icons/ic_launcher.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>Formulir Inspeksi Material Retur</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('icons/ic_launcher.png') }}" type="image/x-icon">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(() => console.log('Service Worker registered'));
        }
    </script>

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    {{-- <title>Formulir Inspeksi Material Retur</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Style untuk canvas tanda tangan -->
    <style>
        canvas {
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: crosshair;
        }

        /* Menghilangkan tombol increment/decrement di input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="justify-items-center">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
