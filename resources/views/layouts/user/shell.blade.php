@extends('layouts.app')

@section('stylesheets')
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">

   <link rel="stylesheet" type="text/css" href="/templates/coco/assets/libs/fontello/css/fontello.css">
   <link rel="stylesheet" type="text/css" href="/templates/coco/assets/libs/font-awesome/css/font-awesome.min.css">
   
   <link rel="stylesheet" type="text/css" href="/assets/css/vendor.css" /> 
   <link rel="stylesheet" type="text/css" href="/assets/css/coco.style.css" />
   <link rel="stylesheet" type="text/css" href="/assets/css/app.css" />

@endsection

@section('scripts')
   
   <script>
      var resizefunc = [];
   </script>

   <script src="/assets/js/vendor.js" type="text/javascript"></script>

   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

     ga('create', '{{config("app.google_analytics_id")}}', 'auto');
   </script>

@endsection

@section('body')

@php
$classSubscribedSports = '';
if(Auth::user()->hasSubscribe('plugin.sports')){
   $classSubscribedSports = 'has-subscribed-sports';
}

$classIsCustomer = '';
if(Auth::user()->type == 'customer'){
   $classIsCustomer = 'is-customer';
}

@endphp

<body id="body" ng-cloak 
      data-base-url="{{ url('/') }}"
      data-csrf="{{ csrf_token() }}"
@if (empty(session('sub_account')))
      data-sub-account=""
      class="
         {{$classSubscribedSports}} 
         {{$classIsCustomer}}
         @yield('bodyClass')"
@else
      data-sub-account="{{Crypt::encrypt(session('sub_account')->id)}}"
      class="
         fixed-left
         pm-friends-{{session('sub_account')->pm_friends}}
         pm-books-{{session('sub_account')->pm_books}}
         pm-sports-{{session('sub_account')->pm_sports}}
         {{$classSubscribedSports}}
         
         @yield('bodyClass')
      "
@endif
      data-env="{{ env('APP_ENV') }}">

   <!-- Begin page -->
   <div id="wrapper">
      <!-- Top Bar Start -->
      <div class="topbar">
         <div class="topbar-left">
            <div class="logo">
               <!-- <h1><a href="#"><img src="/assets/images/logo.png" alt="Logo"></a></h1> -->
            </div>
            <button class="button-menu-mobile open-left">
            <i class="fa fa-bars"></i>
            </button>
         </div>
         <!-- Button mobile view to collapse sidebar menu -->
         <div class="navbar navbar-default" role="navigation" ng-controller="MenuTopController as vm">
            <div class="container">
               <div class="navbar-collapse2">
                  <ul class="nav navbar-nav hidden-xs hide">
                     <li class="language_bar dropdown hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">English <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu pull-right">
                           <li><a href="#">English</a></li>
                           <li><a href="#">中文简体</a></li>
                        </ul>
                     </li>
                  </ul>
                  <ul class="feed nav navbar-nav navbar-right top-navbar">
                     <li class="dropdown iconify hide-phone">
                        <a class="dropdown-toggle" data-toggle="dropdown" ng-click="vm.readFeeds()">
                           <i class="fa fa-globe"></i>
                           <span class="label label-danger absolute" ng-show="vm.model.unreadCount">@{{vm.model.unreadCount}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-message">
                           <li class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications</li>
                           <li class="unread" ng-repeat="feed in vm.model.feeds | limitTo:5">
                              <a ng-href="/books/@{{feed.book_id}}">
                                 <p ng-switch="feed.type">
                                    <strong>@{{feed.actor_name}}.@{{feed.book_name}}</strong> Book 

                                    <br /><span class="equation" ng-bind-html="feed.message"></span>
                                    <br /><i class="fa fa-dot-circle-o"></i> @{{feed.description}}
                                    <br /><br />
                                       <span ng-switch-when="transaction.insert"><i class="fa fa-plus-square"></i> Insert</span>
                                       <span ng-switch-when="transaction.edit"><i class="fa fa-edit"></i> Edit</span>
                                       <span ng-switch-when="transaction.delete"><i class="fa fa-trash-o"></i> Delete</span>
                                    <i><span am-time-ago="feed.created_at | amParse:'YYYY-MM-DD HH:mm:ss'"></span></i>
                                 </p>
                              </a>
                           </li>  
                           <li ng-show="!vm.model.feeds.length">
                              <a>You don't have any notifications.</a>
                           </li>
                           <li class="dropdown-footer">
                              <div class="btn-group btn-group-justified">
                                 <div class="btn-group">
                                    <a class="btn btn-sm btn-primary" ng-click="vm.fetchFeeds()"><i class="icon-ccw-1"></i> Refresh</a>
                                 </div>
                                 <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-success">All the best! <i class="icon-right-open-2"></i></a>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>

                  @if (empty(session('sub_account')))
                     <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<strong></strong> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                           <li class="not-customer"><a href="/profile">My Profile</a></li>
                           <li><a href="/password/change">Change Password</a></li>
                           <li class="not-customer divider"></li>
                           <li class="not-customer"><a href="/sub-account">Sub Accounts</a></li>
                           <li class="not-customer"><a href="/customer-account-bind">As Customer</a></li>
                           <li class="divider"></li>
                           <li><a href="/logout" class="md-trigger"><i class="icon-logout-1"></i> Logout</a></li>
                        </ul>
                     </li>
                  @else
                     <li class="dropdown topbar-profile sub-account">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{session('sub_account')->name}}<strong></strong> <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                           <li><a href="/profile">My Profile</a></li>
                           <li><a href="/password/change">Change Password</a></li>
                           <li><a href="/logout" class="md-trigger"><i class="icon-logout-1"></i> Logout</a></li>
                        </ul>
                     </li>
                  @endif

                     <li class="right-opener">
                        <a href="javascript:;" class="open-right not-customer"><i class="fa fa-angle-double-left"></i><i class="fa fa-angle-double-right"></i></a>
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
                     <a href="#recent-book" class="open-right not-customer"><i class='fa fa-pagelines'></i></a>
                     <a href="/logout" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
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
                  <li class="friends pm-friends"><a href='/friends'><i class='icon-users'></i><span>Friend</span> <span class="pull-right"></span></a></li>
                  <li class="customers pm-friends"><a href='/customers'><i class='icon-adult'></i><span>Customer</span> <span class="pull-right"></span></a></li>
                  
                  @if (Auth::user()->owner())
                     <li class="books pm-books"><a href='/users/{{Auth::user()->owner()->id}}/books'><i class='icon-docs'></i><span>Debt Book</span> <span class="pull-right"></span></a></li>
                  @else
                     <li class="books pm-books"><a href='/books'><i class='icon-docs'></i><span>Debt Book</span> <span class="pull-right"></span></a></li>
                  @endif
                  <li class="sports has_sub pm-sports for-subscribed-sports">
                     <a href='javascript:void(0);' class="active subdrop"><i class='icon-color-adjust'></i><span>Sports Plugin</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                     <ul>
                        <li class="accounts"><a href='/p/sports/accounts'><span>Accounts</span></a></li>
                        <li class="formulas"><a href='/p/sports/formulas'><span>Formula</span></a></li>
                        <li class="settlement"><a href='/p/sports/settlement'><span>Settlement</span></a></li>
                        <li class="settlement-history"><a href='/p/sports/settlement-history'><span>Settlement History</span></a></li>
                     </ul>
                  </li>
                  <!-- <li class="setting"><a href='/setting'><i class='icon-cog'></i><span>Setting</span> <span class="pull-right"></span></a></li> -->
               </ul>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <br><br><br>
         </div>
      </div>
      <!-- Left Sidebar End -->
      <!-- Right Sidebar Start -->
      <div class="right side-menu" ng-controller="MenuRightController as vm">
         <ul class="nav nav-tabs nav-justified" id="right-tabs">
            <li class="active"><a href="#recent-book" data-toggle="tab" title="Recent Book"><i class="fa fa-pagelines"></i></a></li>
            <li><a href="#quick-entry" data-toggle="tab" title="Quick Entry"><i class="fa fa-keyboard-o" aria-hidden="true"></i></a></li>
            <li><a href="#contra-entry" data-toggle="tab" title="Contra Entry"><i class="fa fa-hand-spock-o" aria-hidden="true"></i></a></li>
         </ul>
         <div class="clearfix"></div>
         <div class="tab-content">
            <div class="tab-pane active" id="recent-book">
               <div class="tab-inner slimscroller">
                  <div class="search-right">
                     <input type="text" class="form-control" placeholder="Search" ng-model="vm.model.qsearch">
                  </div>
                  <div class="panel-group" id="collapse">
                     <div class="panel panel-default" id="chat-panel">
                        <div class="panel-heading bg-darkblue-2">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" href="#chat-coll">
                                 <i class="icon-docs"></i> Recent Books
                                 <span class="label bg-darkblue-1 pull-right">@{{vm.model.books.length}}</span>
                              </a>
                           </h4>
                        </div>
                        <div id="chat-coll" class="panel-collapse collapse in">
                           <div class="panel-body">
                              <ul class="list-unstyled" id="chat-list">
                                 <li ng-repeat="book in vm.model.books | filter: vm.search"><a ng-href="/books/@{{book.book_id}}" class="online">
                                 <!-- <span class="chat-user-avatar"><img src="images/users/chat/1.jpg"></span>  -->
                                    <span class="chat-user-name">@{{book.user_name}}</span>
                                    <span class="chat-user-msg">
                                       <span ng-if="book.last_transacted_at" am-time-ago="book.last_transacted_at | amParse:'YYYY-MM-DD HH:mm:ss'"></span> 
                                       @@{{book.book_name}}
                                    </span>
                                 </a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane" id="quick-entry">
               <div class="tab-inner slimscroller">
                  <div class="col-sm-12">
                     <h3>Quick Entry</h3>
                     <div class="row">
                        <div class="col-xs-12">
                           <form>
                              <h5>Book</h5>
                              <div class="form-group">
                                 <select class="form-control" 
         ng-options="book as book.user_name + '.' + book.book_name group by book.user_type for book in vm.model.books | filter:{permission:'write'}" 
                                    ng-model="vm.model.quick.book">
                                 </select>    

                                 <div class="balance before">@{{vm.model.quick.book.balance_debit-vm.model.quick.book.balance_credit | currency:''}}</div>                              
                              </div>    

                              <h5>Amount</h5>
                              <div class="form-group has-success">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control amount" ng-model="vm.model.quick.amount_debit">
                                    <span class="form-control-feedback" aria-hidden="true">$</span>
                                 </div>
                              </div>

                              <div class="form-group has-error">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control amount" ng-model="vm.model.quick.amount_credit">
                                    <span class="form-control-feedback" aria-hidden="true">$</span>
                                 </div>
                              </div>

                              <h5>Description</h5>
                              <div class="form-group">
                                 <input type="text" class="form-control description" 
                                    ng-model="vm.model.quick.description"
                                    placeholder="description">
                              </div>
                              <br>
                              <h5>Amount after submit</h5>
                              <div class="balance after">
                                 @{{
                                    + +vm.model.quick.book.balance_debit 
                                    - +vm.model.quick.book.balance_credit
                                    + +vm.model.quick.amount_debit.replace(',','')
                                    - +vm.model.quick.amount_credit.replace(',','')
                                 | currency:''}}
                              </div>
                              <button type="button" class="btn btn-success btn-lg btn-block submit" ng-click="vm.submitEntry(vm.model.quick)">
                                 Submit
                              </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane" id="contra-entry">
               <div class="tab-inner slimscroller">
                  <div class="panel-group" id="collapse">
                     <div class="panel panel-default">
                        <div class="panel-heading bg-orange-1">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#rnotifications">
                                 <i class="icon-bell-2"></i> Contra Entry
                              </a>
                           </h4>
                        </div>
                        <div id="rnotifications" class="panel-collapse collapse in">
                           <div class="panel-body">

                              <a class="btn btn-block btn-sm btn-warning">Coming Soon</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Right Sidebar End -->    
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
               <div class="footer-links pull-right">
                  <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Help</a><a href="#">Contact Us</a>
               </div>
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