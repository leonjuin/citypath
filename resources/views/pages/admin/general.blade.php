@extends('layouts.admin.shell')
@section('title', 'Welcome')
@section('bodyClass', '')

@section('stylesheets')
	@parent

@endsection

@section('scripts')
	@parent
	<script src="/assets/js/admin/app.js"></script>
	
@endsection

@section('content')
<div ng-view></div>
@endsection