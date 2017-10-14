<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - Asiatic Hotel</title>
	@include('includes.head')
    <script type="text/javascript" src="/assets/js/vendor.js"></script>
</head>
<body>
	<div id="preloader">
        <span class="preloader-dot"></span>
    </div>
     <!-- PAGE WRAP -->
    <div id="page-wrap">

        <!-- HEADER -->
        <header id="header">
        	@include('includes.header')
        </header>

        <!-- CONTENT -->
 		@yield('content')

        <!-- FOOTER -->
        <footer id="footer">
            @include('includes.footer')
        </footer>
    </div>

    <!-- LOAD JQUERY -->
    <!-- Custom jQuery -->
       <!-- <script type="text/javascript" src="/assets/js/app.js"></script> -->
      
     
      <script type="text/javascript" src="/assets/js/vendor.js"></script>
       <script type="text/javascript" src="/templates/lotus/assets/js/user/vendor.js"></script>
      <script type="text/javascript" src="/assets/js/app.js"></script>


</body>
</html>