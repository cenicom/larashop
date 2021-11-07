<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('template/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('template/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" class="dashboard-sales" />

    <link href="{{asset('template/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/plugins/font-icons/fontawesome/css/fontawesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/css/fontawesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('template/assets/css/widgets/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template\assets\css\forms\theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<style>
    aside{
        display: none!importan;
    }

    .page-item.active .page-link{
        z-index: 3;
        color: #fff;
        background-color: #3B3F5C;
        border-color: #3B3F5C;
    }

    @media (max-width: 480px){
        .mtmobile{
            margin-botton: 20px!important;
        }

        .mbmobile{
            margin-botton: 10px!important;
        }

        .hideonsm{
            display: none!important;
        }

        .inblock{
            display: block;
        }
    }

    .sidebar-theme #compactSidebar{
        background: #191e3a!important;
    }

    .header-container .sidebarCollapse{
        color: #3b3f5c!important;
    }

    .navbar .navbar-item .nav-item
    .form-inline.search
    .search-form-control{
        font-size: : 15px;
        background-color: #3b3f5c!important;
        padding-right: 40px;
        padding-top: 12px;
        border: none;
        color: white;
        box-shadow: none;
        border-radius: 30px;
    }
</style>

@livewireStyles
