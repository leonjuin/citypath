<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} Admin</title>

    <link href="{{templateUrl('/cleanui/assets/common/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{templateUrl('/cleanui/assets/common/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{templateUrl('/cleanui/assets/common/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{templateUrl('/cleanui/assets/common/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{templateUrl('/cleanui/assets/common/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="/templates/lotus/assets/images/favicon.png" rel="shortcut icon">


    <link rel="stylesheet" type="text/css" href="{{templateUrl('/cleanui/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{templateUrl('/cleanui/assets/common/css/source/main.css')}}">
    <script src="{{templateUrl('/cleanui/vendor.js')}}"></script>
    <script src="{{templateUrl('/cleanui/assets/common/js/common.js')}}"></script>
    <style type="text/css">
        .background2{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/2.jpg')}}); }
        .background3{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/3.jpg')}}); }
        .background4{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/4.jpg')}}); }
        .background5{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/5.jpg')}}); }
        .background6{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/6.jpg')}}); }
        .background7{ background: url({{templateUrl('/cleanui/assets/common/img/temp/login/7.jpg')}}); }
    </style>
</head>

<body class="{{$background or ''}}">
@yield('content')
</body>
</html>