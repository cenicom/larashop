<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('template/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/app.js') }}"></script>
    <script src="{{ asset('template/assets/js/loader.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('template/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('template/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard/dash_2.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('template/plugins/sweetalerts/sweetalert2.min.js')}}">
    <script src="{{asset('template/plugins/notification/snackbar/snackbar.min.js')}}">
    <script src="{{asset('template/plugins/nicescroll/nicescroll.min.js')}}">
    <script src="{{asset('template/plugins/currency/currency.min.js')}}">
    </script>


<script>
    function noty(msg, option = 1)
    {
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionColor: '#fff',
            backgroundColor: option == 1 ? '#3B3F5C' : '#E7515A',
            pos: 'top-right',
        });
    }

</script>

@livewireScripts
