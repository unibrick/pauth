<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'App Name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

</head>
<body class="bg-slate-300 dark:bg-gray-900">
<div id="app" class="min-h-screen flex flex-col">
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 grow px-4 sm:p-0">
        <div class="py-6">
            <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-md md:max-w-3xl">
                <div class="relative hidden sm:block sm:w-2/5">
                    <div class="absolute backdrop-blur-sm h-full w-full bg-cyan-400/30"></div>
                    <img class="opacity-80 h-full object-cover" src="{{ Vite::asset('./resources/images/bsbg.png') }}">
                </div>

                <div class="w-full p-8 sm:w-3/5">
                    <x-twcompo::application-logo class="w-10 h-10 fill-current text-gray-500"/>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>




