@extends('layouts.app')

@section('stylesheets')
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">

   <link rel="stylesheet" type="text/css" href="/templates/coco/assets/libs/fontello/css/fontello.css">
   <link rel="stylesheet" type="text/css" href="/templates/coco/assets/libs/font-awesome/css/font-awesome.min.css">
   
   <link rel="stylesheet" type="text/css" href="/assets/css/admin/vendor.css" /> 
   <link rel="stylesheet" type="text/css" href="/assets/css/coco.style.css" />
   <link rel="stylesheet" type="text/css" href="/assets/css/admin/app.css" />


@endsection

@section('scripts')
   
   <script>
      var resizefunc = [];
   </script>

   <script src="/assets/js/admin/vendor.js" type="text/javascript"></script>

   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

     ga('create', '{{config("app.google_analytics_id")}}', 'auto');
   </script>

@endsection

@section('body')

<body id="body" ng-cloak 
      data-base-url="{{ url('/') }}"
      data-csrf="{{ csrf_token() }}"
      class="@yield('bodyClass')"
      data-env="{{ env('APP_ENV') }}">

   <!-- Begin page -->
   <div id="wrapper">
      <!-- Top Bar Start -->
      <div class="topbar">
         <div class="topbar-left" style="background-image: none;">
            <div class="logo" style="height: 100%">
               <img src="/templates/lotus/assets/images/logo-header.png" alt="Logo">
            </div>
            <button class="button-menu-mobile open-left">
            <i class="fa fa-bars" style="color: black"></i>
            </button>
         </div>
         <!-- Button mobile view to collapse sidebar menu -->
         <div class="navbar navbar-default" role="navigation" ng-controller="MenuTopController as vm">
            <div class="container">
               <div class="navbar-collapse2">
                  <ul class="feed nav navbar-nav navbar-right top-navbar">
                     <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<strong></strong> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                           <li><a href="/admin/password/change">Change Password</a></li>
                           <li class="divider"></li>
                           <li><a href="/admin/logout" class="md-trigger"><i class="icon-logout-1"></i> Logout</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <!--/.nav-collapse -->
            </div>
         </div>
      </div>
      <!-- Top Bar End -->
      <!-- Left Sidebar Start -->
      <div class="left side-menu">
         <div class="sidebar-inner slimscrollleft">
            <!--- Profile -->
            <div class="profile-info">
               <div class="col-xs-8">
                  <div class="profile-text top-15px">Welcome</div>
                  <div class="profile-text"><b>{{Auth::User()->name}}</b></div>
                  <div class="profile-buttons">
                     <a href="/admin/logout" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                     <a href="/admin/" title="Home"><i class="fa fa-home"></i></a>
                  </div>
               </div>
            </div>
            <!--- Divider -->
            <div class="clearfix"></div>
            <hr class="divider" />
            <div class="clearfix"></div>
            <!--- Divider -->
            <div id="sidebar-menu">
               <ul>
                  <li class="category"><a href='/admin/'><i class="fa fa-home" aria-hidden="true"></i><span>Home</span> <span class="pull-right"></span></a></li>
                  
               </ul>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <br><br><br>
         </div>
      </div>
      <!-- Left Sidebar End -->

      <!-- Start right content -->
      <div class="content-page">
         <ol class="breadcrumb">
         <!--             
            <li><a>Home</a></li>
            <li class="active">Debt Book</li> 
         -->
         </ol>
         <!-- ============================================================== -->
         <!-- Start Content here -->
         <!-- ============================================================== -->
         <div class="content">
            @yield('content')
            <footer class="hidden-xs">
               Dynamic Function Tech &copy; 2017
            </footer>
         </div>
         <!-- ============================================================== -->
         <!-- End content here -->
         <!-- ============================================================== -->
      </div>
      <!-- End right content -->
   </div>
   <!-- End of page -->
   <!-- the overlay modal element -->
   <div class="md-overlay"></div>
   <!-- End of eoverlay modal -->
</body>
@endsection