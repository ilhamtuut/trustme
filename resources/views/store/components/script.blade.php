<script src="{{asset('assets-store/lbr/js/vendor/jquery-3.5.1.min.js')}}"></script>    
<script src="{{asset('assets-store/lbr/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/vendor/modernizr-3.11.2.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/countdown.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/venobox.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/plugins/ajax-mail.js')}}"></script>
<script src="{{asset('assets-store/lbr/js/main.js')}}"></script>
<script>
     $(document).ready(function() {
        @if (session('alert-store'))
        $('.alert-store').html(`<div class="header-to-bar" style="background-color: {{session('alert-store')['status'] == 'success' ? '#8dc647' : '#fb5d5d'}}; color: #474747;">{{session('alert-store')['message']}}</div>`);
        setTimeout(function() {
            $('.alert-store').html('');
       }, 2500);
        @endif
   });
</script>
@yield('scriptsStore')
