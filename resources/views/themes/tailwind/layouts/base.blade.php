<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">

    @if (isset($seo->description))
        <meta name="description" content="{{ $seo->description }}">
    @endif
    @if (isset($seo->title) && isset($seo->description) && isset($seo->image))
        <meta property="og:title" content="{{ $seo->title }}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:image" content="{{ $seo->image }}">
        <meta property="og:type"
            content="@if (isset($seo->type)) {{ $seo->type }}@else{{ 'article' }} @endif">
        <meta property="og:description" content="{{ $seo->description }}">
        <meta property="og:site_name" content="{{ setting('site.title') }}">

        <meta itemprop="name" content="{{ $seo->title }}">
        <meta itemprop="description" content="{{ $seo->description }}">
        <meta itemprop="image" content="{{ $seo->image }}">

        @if (isset($seo->image_w) && isset($seo->image_h))
            <meta property="og:image:width" content="{{ $seo->image_w }}">
            <meta property="og:image:height" content="{{ $seo->image_h }}">
        @endif
    @endif

    @if (isset($seo->title))
        <title>{{ $seo->title }}</title>
    @else
        <title>
            {{ setting('site.title', 'Laravel Wave') . ' - ' . setting('site.description', 'The Software as a Service Starter Kit built on Laravel & Voyager') }}
        </title>
    @endif


    <link rel="icon" href="{{ Voyager::image(setting('site.favicon', '/wave/favicon.png')) }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Helvetica Neue', Helvetica, sans-serif;
            font-size: 14px;
        }
        .days {
            display: none;
        }
    </style>

    @yield('style')
    <!-- <script>
        const theme = localStorage.getItem('theme') ?? 'dark'
        document.documentElement.className = theme
    </script> -->

    @filamentStyles
    <link href="{{ asset('css/flowbite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/' . $theme->folder . '/css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased bg-grey-100 leading-normal tracking-normal font-inter @if (config('wave.dev_bar')) {{ 'pb-10' }} @endif">
    @include('theme::partials.sidebar')
    <div class="mt-14 sm:ml-64">
        @yield('content')
        @include('theme::partials.footer2')
    </div>
    
    @include('theme::partials.toast')
    @if(session('message'))
        <script>setTimeout(function(){ popToast("{{ session('message_type') }}", "{{ session('message') }}"); }, 10);</script>
    @endif
    @waveCheckout
    
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/d76d32a947.js" crossorigin="anonymous"></script>
    @filamentScripts
    {{-- @livewire('notifications') --}}

    @yield('scripts')
</body>

</html>
