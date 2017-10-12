@extends('layouts.app')

@section('stylesheets')

@endsection

@section('scripts')

@endsection

@section('body')
<body class="fixed-left" 
      data-env="{{ env('APP_ENV') }}"
      data-base-url="{{ url('/') }}"
      data-csrf="{{ csrf_token() }}"
      class="@yield('bodyClass')">
  
      <h1>LOGIN</h1>
</body>
@endsection