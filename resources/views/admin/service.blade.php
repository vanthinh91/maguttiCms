<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="MaguttiCms"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('maguttiCms.admin.option.title') }}</title>
    <link rel="icon" href="{{ asset('/favicon.jpg') }}" type="any" sizes="20x20">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400"/>
    <link rel="stylesheet" href="{{ asset(config('maguttiCms.admin.path.common_css').'ma_helper.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('cms/css/vendor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('cms/css/app.css')) }}">
    <script type="text/javascript">
        // init some global variable
        var _SERVER_PATH = "{{ url('') }}";
        var _LOCALE = "{{ LaravelLocalization::getCurrentLocale() }}";
        var _CURMODEL = "{{ (isset($pageConfig['model']) ? $pageConfig['model'] : "" ) }}";
    </script>
</head>

<body class="login">
    <div id="app">
        @yield('content')
    </div>

    @yield('footerjs')
</body>
</html>
