@php
    $maindata = App\MainData::first();
@endphp

<link rel="shortcut icon" href="{{ URL::asset('uploads/'.$maindata->logo) }}">
@yield('css')
<!-- Basic Css files -->
@if(session('lang') == 'en')
<link href="{{ URL::asset('public/admin/en/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/admin/en/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/admin/en/css/style.css') }}" rel="stylesheet" type="text/css">
@else
<link href="{{ URL::asset('public/admin/ar/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/admin/ar/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('public/admin/ar/css/style.css') }}" rel="stylesheet" type="text/css">
@endif
