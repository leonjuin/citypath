<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} Login</title>

    <link href="{{asset('/templates/cleanui/assets/common/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{asset('/templates/cleanui/assets/common/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{asset('/templates/cleanui/assets/common/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{asset('/templates/cleanui/assets/common/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{asset('/templates/cleanui/assets/common/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="favicon.ico" rel="shortcut icon">

    <link rel="stylesheet" type="text/css" href="{{assetUrl('/css/admin/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{templateUrl('/cleanui/assets/common/css/source/main.css')}}">
    <script src="{{assetUrl('/js/admin/vendor.js')}}"></script>
    <script src="{{templateUrl('/cleanui/assets/common/js/common.js')}}"></script>
</head>
<body>
@yield('content')
</body>
</html>