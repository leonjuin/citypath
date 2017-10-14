<!doctype html>
<html ng-app="app">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{config('app.name')}} | @yield('title')</title>

    <base href="/">

    @include('includes.opengraph')
    
    @include('includes.favicons')

    @yield('stylesheets')
	
</head>
@yield('body')
@yield('scripts')
</html>