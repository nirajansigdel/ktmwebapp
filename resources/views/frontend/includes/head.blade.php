<head>
    <?php
    // Make favicon optional; avoid hard dependency on a missing model
    $favicon = null;
    if (class_exists(\App\Models\Favicon::class)) {
        $favicon = \App\Models\Favicon::first();
    }
    ?>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!-- Mobile Specific Metas -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Trademark Education Consultancy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />

    <link rel="icon" type="image/png" href="{{ asset(optional($favicon)->favicon_ico ? 'uploads/favicon/' . $favicon->favicon_ico : 'favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(optional($favicon)->apple_touch_icon ? 'uploads/favicon/' . $favicon->apple_touch_icon : 'favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset(optional($favicon)->favicon_thirtyTwo ? 'uploads/favicon/' . $favicon->favicon_thirtyTwo : 'favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset(optional($favicon)->favicon_sixteen ? 'uploads/favicon/' . $favicon->favicon_sixteen : 'favicon.ico') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/' . $favicon->favicon_ico) }}"> --}}
    {{-- <link rel="manifest" href="{{ asset('uploads/favicon/file' . $favicon->file) }}"> --}}
    <link rel="manifest" href="{{ asset(optional($favicon)->site_webmanifest ? 'uploads/favicon/file' . $favicon->site_webmanifest : 'site.webmanifest') }}">


    <meta name="msapplication-TileImage" content="{{ asset('adminassets/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('adminassets//assets/js/config.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>


    <meta name="author" content="BibekGuragain">
    <meta name="generator" content="Trademark Education Consultancy">



    <title>{{ config('app.name', 'Laravel') }}</title>




    <!-- Google reCAPTCHA -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    {{-- {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!} --}}

    <!-- Other scripts and callbacks as needed -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">





    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
