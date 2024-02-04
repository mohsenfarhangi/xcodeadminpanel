<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/scss/app.scss'])
        @vite(['resources/scss/dashboard.scss'])
    </head>
    <body>
    @include('layouts.header')
    <!-- Page Content -->
    <main>
        <div class="container py-3">
            {{ $slot }}
        </div>
    </main>
    </body>
    @vite(['resources/js/app.js'])
    @vite(['resources/js/dentists/index.js'])
    @stack('scripts')
</html>
