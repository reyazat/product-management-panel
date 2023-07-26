<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <x-panel.meta :pageinfo="$pageinfo" />


    <link rel="stylesheet" href="{{ url('css/panel/auth.css') }}">
    <link rel="stylesheet" href="{{ url('assets/icons/Ionicons/css/ionicons.css') }}">



</head>

<body class="hold-transition theme-primary bg-img rtl">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            {{ $slot }}
        </div>
    </div>
    <script src="{{ url('js/vendors.min.js') }}"></script>
    <script src="{{ url('/assets/icons/feather-icons/feather.min.js') }}"></script>


    {{ $script }}

</body>

</html>
