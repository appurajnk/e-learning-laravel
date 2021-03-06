@php
    $config = [
        'url' => setting('site.site_url') ? setting('site.site_url') : url('/'),
        'locale' => app()->getLocale(),
        'demo_mode' => (int)setting('site.enable_demo_mode')
    ];
@endphp
<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ setting('site.favicon') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LearnIt</title>
    <meta name="description" content="@yield('meta_description', setting('site.site_description'))">
    <meta name="author" content="@yield('meta_author', 'LearnIt')">
    @yield('meta')

    <script>window.config = @json($config);</script>

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    @stack('after-styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.includes.header')

    <div id="app" class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    <script src="/js/lang.js"></script>
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')
</body>
</html>
