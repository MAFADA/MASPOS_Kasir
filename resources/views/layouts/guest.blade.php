<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 relative">
        <div class="absolute bg-blue-700 h-1/2 w-full -top-0">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 z-10 -top-60">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <h2 class="font-semibold text-xl text-white leading-tight">
                            {{ __('MASPOS') }}
                        </h2>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div align="right" width="48">
                        <div>
                            <div
                                class="inline-flex items-center px-3 py-2 border border-transparent text-xl leading-4 font-medium rounded-md text-white bg-transparent hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                <div class="px-3">Call Us +62 817-1902-092</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center m-5 z-10">
                <h2 class="font-semibold text-xl text-black leading-tight">
                    {{ __('Login') }}
                </h2>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
