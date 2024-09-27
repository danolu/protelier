<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>

<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>

<script src="{{asset('assets/js/config.js')}}"></script>

<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
@yield('script')

@if(Route::current()->getName() != 'popover') 
	<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
@endif

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: '{{ session('success') }}'
        })
    </script>
    @endif

    @if (session('alert'))
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
          
          Toast.fire({
            icon: 'error',
            title: '{{ session('alert') }}'
          })
    </script>
    @endif

    @if (session('message'))
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
          
          Toast.fire({
            icon: 'success',
            title: '{{ session('message') }}'
          })
    </script>
    @endif

    
<script src="{{asset('assets/js/script.js')}}"></script>

@if(Route::currentRouteName() == 'index')
<script>
	new WOW().init();
</script>
@endif
