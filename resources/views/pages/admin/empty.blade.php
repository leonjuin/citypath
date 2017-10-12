@extends('layouts.user.shell')
@section('title', 'Welcome')
@section('bodyClass', '')

@section('stylesheets')
	@parent

@endsection

@section('scripts')
	@parent
	<script src="/assets/js/app.js"></script>
@endsection

@section('content')
HELLO
@endsection