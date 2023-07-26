<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <x-panel.meta :pageinfo="$pageinfo" />

    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/morris.js/morris.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/OwlCarousel2/dist/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/OwlCarousel2/dist/assets/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/horizontal-timeline/css/horizontal-timeline.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/flexslider/flexslider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/prism/prism.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/Magnific-Popup-master/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/gallery/css/animated-masonry-gallery.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/lightbox-master/dist/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/jvectormap/lib2/jquery-jvectormap-2.0.2.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/bootstrap-markdown-master/css/bootstrap-markdown.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap-select/dist/css/bootstrap-select.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/raty-master/lib/jquery.raty.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/ion-rangeSlider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/ion-rangeSlider/css/ion.rangeSlider.skinModern.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/gridstack/gridstack.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/nestable/nestable.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap-switch/switch.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/chartist-js-develop/chartist.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/bootstrap-slider/slider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/weather-icons/weather-icons.css') }}">

    <link rel="stylesheet" href="{{ url('css/color_theme.css') }}">
    <link rel="stylesheet" href="{{ url('css/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ url('css/style_rtl.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/linea-icons/linea.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/glyphicons/glyphicon.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/flag-icon-css/css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/material-design-iconic-font/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/cryptocoins-master/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/iconsmind/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor_components/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/skin_color.css') }}">


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

        <!-- panel.drop-down-box -->

    </div>
    <!-- ./wrapper -->
    <script src="{{ url('js/vendors.min.js') }}"></script>
    <script src="{{ url('assets/icons/feather-icons/feather.min.js') }}"></script>

    <!-- WebkitX Admin App -->
    <script src="{{ url('js/template.js') }}"></script>

    {{ $script }}
</body>

</html>
