	<meta property="fb:app_id" content="{{config('services.facebook.client_id')}}" /> 
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:description" content="Crowbar" />
	<meta property="og:url" content="{!! Request::url() !!}" />
	<meta property="og:site_name" content="{{config('app.name')}}" />
	<meta property="og:image" content="/assets/images/shares/facebook.1200x630.jpg" />
	<link rel="canonical" href="{!! Request::url() !!}" />


	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="{{ '@' . config('crowbar.twitter_username') }}">
	<meta name="twitter:creator" content="{{ '@' . config('crowbar.twitter_username') }}">
	<meta name="twitter:title" content="@yield('title')">
	<meta name="twitter:description" content="@yield('description')">
	<meta name="twitter:image:src" content="{{ config('crowbar.cdn.static') }}/social/xxx.png">
