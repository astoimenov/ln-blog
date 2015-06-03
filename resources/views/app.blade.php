<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LittleNinja's blog</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

@include('partials.header')
<div class="container">
    <div class="row relative">
        <div class="col-md-8 col-sm-8">
            @yield('content')
        </div>

        <div class="col-md-4 col-sm-4 aside-holder">
            @include('partials.sidebar-baner')
        </div>
    </div>
</div>
@include('partials.footer')

@yield('scripts')
</body>
</html>
