<!DOCTYPE html>
<html>
    <head>
        @php
            $main_data = App\MainData::first();
        @endphp
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{$main_data->name_ar}}</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @include('layouts.head')


    </head>
    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
        <div id="wrapper">
            @if(session('lang') == 'en')
            @include('layouts.header-en')
            @else
            @include('layouts.header')
            @endif

            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    @include('layouts.sidebar')
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
        @include('layouts.footer-script')
    </body>
</html>

