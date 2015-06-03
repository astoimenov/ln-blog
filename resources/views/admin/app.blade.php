<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Admin | LittleNinja's blog</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/bootstrap/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('/admin/stylesheets/admin/style-metronic.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/admin/stylesheets/admin/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/admin/stylesheets/admin/style-responsive.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/admin/stylesheets/admin/themes/default.css') }}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{ asset('/admin/stylesheets/admin/custom.css') }}" rel="stylesheet" type="text/css"/>
    @yield('styles')
</head>
<body class="page-header-fixed">
@include('admin.partials.header')
<div class="clearfix"></div>

<div class="page-container">
    @yield('content')
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js" type="text/javascript"></script>
@yield('scripts')
<script src="{{ asset('/admin/scripts/admin/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/admin/scripts/admin/common.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
</body>
</html>
