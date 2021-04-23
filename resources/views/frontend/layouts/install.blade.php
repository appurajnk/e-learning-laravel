<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'ArcInspire')">
        <meta name="author" content="@yield('meta_author', 'ArcInspire')">
        @yield('meta')
        {{ style(mix('css/frontend.css')) }}
        <link href="/css/installer.css" rel="stylesheet">

    </head>
    <body class="hold-transition h-100">
        <div id="app">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="mb-2 text-center">
                            <h1 class="h3">{{ app_name() }} <span class="font-12">v{{ app_version() }}</span></h1>
                            <div class="bg-white">
                                <ul class="progressbar">
                                    <li class="{{ active_class(Route::is('frontend.installer.index')) }}">Start</li>
                                    <li class="{{ active_class(Route::is('frontend.installer.requirements')) }}">Requirements</li>
                                    <li class="{{ active_class(Route::is('frontend.installer.database')) }}">Database</li>
                                    <li class="{{ active_class(Route::is('frontend.installer.settings')) }}">Settings</li>
                                    <li class="{{ active_class(Route::is('frontend.installer.mail')) }}">Mail</li>
                                    <li class="{{ active_class(Route::is('frontend.installer.finish')) }}">Finish</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        @yield('content')
                    </div>
                </div>
            </div>
            
        </div><!-- #app -->

        <!-- Scripts -->
        <script src="/js/lang.js"></script>
        {!! script(mix('js/frontend.js')) !!}
    </body>
</html>
