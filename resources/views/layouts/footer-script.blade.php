@if(session('lang') == 'en')
<script src="{{ URL::asset('public/admin/en/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/waves.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/jquery.nicescroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/en/js/jquery.scrollTo.min.js') }}"></script>
@else
<script src="{{ URL::asset('public/admin/ar/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/waves.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/jquery.nicescroll.js') }}"></script>
<script src="{{ URL::asset('public/admin/ar/js/jquery.scrollTo.min.js') }}"></script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="{{url('assets/hijri/js/bootstrap-hijri-datetimepickermin.js')}}"></script>

<script>
    window.addEventListener('click', function(e){
        if (document.getElementById('language-list').contains(e.target)){
            $('.language-switch').css('visibility','visible');
            $('.profile-dropdown').css('visibility','hidden');
        } else if (document.getElementById('notification-list').contains(e.target)){
            $('.profile-dropdown').css('visibility','visible');
            $('.language-switch').css('visibility','hidden');
        }else{
            $('.language-switch').css('visibility','hidden');
            $('.profile-dropdown').css('visibility','hidden');
        }
    });
</script>

 @yield('script')

 <!-- App js -->
 @if(session('lang') == 'en')
 <script src="{{ URL::asset('public/admin/en/js/app.js') }}"></script>
 @else
 <script src="{{ URL::asset('public/admin/ar/js/app.js') }}"></script>
 @endif
 
@yield('script-bottom')

