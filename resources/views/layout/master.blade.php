<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ theme()->printHtmlAttributes('html') }}>
<!--begin::Head-->
<head>
    <title>{{ ucfirst(theme()->getOption('meta', 'title')) }}</title>
    <meta charset="utf-8"/>
    <meta name="description" content="{{ ucfirst(theme()->getOption('meta', 'description')) }}"/>
    <meta name="keywords" content="{{ theme()->getOption('meta', 'keywords') }}"/>
    <link rel="canonical" href="{{ ucfirst(theme()->getOption('meta', 'canonical')) }}"/>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon"
          href="{{ asset(theme()->getOption('assets', 'favicon', $settings['favicon'] ?? 'media/logos/favicon.png')) }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/assets/sass/style.scss'])

    @if (theme()->hasOption('assets', 'css'))
        {{-- begin::Global Stylesheets Bundle(used by all pages) --}}
        @foreach (theme()->getOption('assets', 'css') as $file)
            <link href="{{ assetIfHasRTL($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Global Stylesheets Bundle --}}
    @endif

    @if (theme()->hasOption('page', 'assets/vendors/css'))
        {{-- begin::Page Vendor Stylesheets(used by this page) --}}
        @foreach (theme()->getOption('page', 'assets/vendors/css') as $file)
            <link href="{{ assetIfHasRTL($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Page Vendor Stylesheets --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/css'))
        {{-- begin::Page Custom Stylesheets(used by this page) --}}
        @foreach (theme()->getOption('page', 'assets/custom/css') as $file)
            <link href="{{ assetIfHasRTL($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Page Custom Stylesheets --}}
    @endif

    @yield('custom-styles')
    @yield('custom-scripts')

    @yield('styles')
</head>
<!--end::Head-->

<!--begin::Body-->
<body {!! theme()->printHtmlAttributes('body') !!} {!! theme()->printHtmlClasses('body') !!} {!! theme()->printCssVariables('body') !!} >

@include('partials/theme-mode/_init')

@if (theme()->getOption('layout', 'loader/display') === true)
    {{ theme()->getView('layout/_loader') }}
@endif

@yield('content')

{{-- begin::Javascript --}}
<script src="{{asset('/js/lang.js')}}"></script>
<script type="application/javascript">
    function trans(key, replace = {}) {
        let translation = key.split('.').reduce((t, i) => t[i] || null, window.i18n);


        for (var placeholder in replace) {
            translation = translation.replace(`:${placeholder}`, replace[placeholder]);
        }

        return translation;
    }
</script>
@vite(['resources/assets/js/app.js'])
@if (theme()->hasOption('assets', 'js'))
    {{-- begin::Global Javascript Bundle(used by all pages) --}}
    @foreach (theme()->getOption('assets', 'js') as $file)
        <script src="{{ asset($file) }}"></script>
    @endforeach
    {{-- end::Global Javascript Bundle --}}
@endif

@if (theme()->hasOption('page', 'assets/vendors/js'))
    {{-- begin::Page Vendors Javascript(used by this page) --}}
    @foreach (theme()->getOption('page', 'assets/vendors/js') as $file)
        <script src="{{ asset($file) }}"></script>
    @endforeach
    {{-- end::Page Vendors Javascript --}}
@endif

@if (theme()->hasOption('page', 'assets/custom/js'))
    {{-- begin::Page Custom Javascript(used by this page) --}}
    @vite(theme()->getOption('page', 'assets/custom/js'))
    {{-- end::Page Custom Javascript --}}
@endif
{{-- end::Javascript --}}

@yield('scripts')

</body>
<!--end::Body-->

</html>
