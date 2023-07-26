<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <x-panel.meta :pageinfo="$pageinfo" />

    <link rel="stylesheet" href="{{ url('css/vendor_pages_css.css') }}">

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary rtl">

    <div class="wrapper">

        <x-panel.navbar />

        <x-panel.right-menu />

        <div class="content-wrapper">
            <div class="container-full">
                <x-panel.breadcrumbs :breadcrumbs="$pageinfo['breadcrumbs']" />


                <!-- Main content -->
                <section class="content">


                    {{ $slot }}


                </section>
                <!-- /.content -->

            </div>
        </div>
        <x-panel.footer />

        {{ $dropdownbox }}
    </div>
    <!-- ./wrapper -->
    <script src="{{ url('js/vendors.min.js') }}"></script>
    <script src="{{ url('assets/icons/feather-icons/feather.min.js') }}"></script>

    <!-- WebkitX Admin App -->
    <script src="{{ url('js/template.js') }}"></script>

    {{ $script }}
</body>

</html>
