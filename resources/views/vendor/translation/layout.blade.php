<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/vendor/translation/css/main.css">
    {{ style(mix('css/backend.css')) }}
    
</head>
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.includes.header')
    <div id="app" class="app-body ">
        @include('backend.includes.sidebar')
        <main class="main">
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn trans">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('translation::notifications')
                    @yield('body')
                </div><!--animated-->
            </div><!--container-fluid-->

            
            
        </main>
    </div>
    <!-- <script src="/vendor/translation/js/app.js"></script> -->
    <script src="/js/lang.js"></script>
    {!! script(mix('js/backend.js')) !!}
</body>
</html>