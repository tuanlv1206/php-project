<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="/favicon.ico?v=2" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Chu thuê nhà mặt phố, nhà riêng, căn hộ, chung cư, cửa hàng, ki ốt, nhà trọ tại Hà Nội."/>
    <title>@yield('title') | {{ trans('layouts/master.name') }}</title>
    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="/assets/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')

    <div id="loader"></div> <!-- make switching pages smother -->

    @yield('content')

    @include('layouts.footer')

    <a href="#0" class="cd-top">Top</a> <!-- back to top button -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/bootstrap.file-input.js"></script>
    <script src="/assets/js/all.js"></script>
    @yield('scripts')
</body>
</html>
