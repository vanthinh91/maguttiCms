<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Magutti" />
    <meta name="google-site-verification" content="{{data_get($site_settings,'GA_SITE_VERIFICATION')}}" />
    <meta name="theme-color" content="{{data_get($site_settings,'THEME_COLOR')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Meta SEO --}}
    {!! SEO::generate() !!}

</head>
<body>

    <div class="container ">
        <div class="row text-center" style="height: 100%;top: 40%;position: absolute;
    left: 0;
    right: 0;">
            <div class="col-xs-12" style="text-align: center;">
                <img class="center-block"
                     src="{!! asset(config('laraCms.admin.path.assets').'website/images/logo.png') !!}"
                     alt="{{ config('laraCms.website.option.app.name') }}">
            </div>
        </div>
    </div>
</body>
</html>