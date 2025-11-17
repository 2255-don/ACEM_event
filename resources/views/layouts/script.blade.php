    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>

   

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->
    <script src="{{asset('assets/js/ui-toasts.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>


<script>
        // Options globales
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-center',
            timeOut: 3000,
            extendedTimeOut: 1000,
        };
</script>

@foreach (['success','error','warning','info'] as $type)
    @if (session()->has($type))
        <script>
            toastr["{{ $type }}"]({!! json_encode(session($type)) !!});
        </script>
    @endif
@endforeach

