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
<div class="ng-container create">
    <div class="page-heading">
        <h1><i class='icon-adult'></i> Change Password For {{ Auth::user()->name }}</h1>
        <h3>Change personal password.</h3>              
    </div>

    <div class="row new-list">
        <div class="col-md-12">

            <div class="alert alert-danger">
                    <div class="messages">
                        <i class='fa fa-warning fa-2x'></i>

                        <span class="require-name">name is require.</span>
                        <span class="min-name">name must be at least 4 characters.</span>
                        <span class="require-username">username is require.</span>
                        <span class="min-username">username must be at least 4 characters.</span>
                        <span class="unique-username">username is taken, please rename.</span>
                        <span class="require-password">password is require.</span>
                        <span class="min-password">password must be at least than 6 characters.</span>
                        <span class="unexpected">unexpected error, please inform customer support.</span>
                        
                    </div>
            </div>  
            
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="post" action="{{ url('/password/change/') }}">
                    {{ csrf_field() }}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="40">#</th>
                                    <th class="password" width="180">
                                        Old Password
                                    </th>
                                    <th class="password" width="180">
                                        New Password
                                    </th>
                                    <th class="password" width="180">
                                        Confirm New Password
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center">@{{ $index + 1}}</th>
                                    <td class="password">
                                        <input type="password" class="form-control" name="old_password" required>
                                    </td> 
                                    <td class="password">
                                        <input type="password" class="form-control" name="password" required>
                                    </td> 
                                    <td class="password">
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </td> 
                                </tr>

                                @if(count($errors) > 0)
                                <tr>
                                    <td colspan="4" class="text-danger">*<em>{{ $errors->first() }}</em></td>
                                </tr>
                                @endif

                                @if(Session::has('old-password-error'))
                                <tr>
                                    <td colspan="4">{{ Session::get('old-password-error') }}</td>
                                </tr>
                                @endif
                                                        
                            </tbody>                                
                        </table>

                        <button type="submit" class="btn btn-info create">Change</button>
                    </form>                     
                </div>
            </div>          
        </div>

    </div>
</div>
@if(Session::has('change-password-success'))
    <script type="text/javascript">
        swal(
            'Congratulations!',
            'You have successfully updated your password!',
            'success'
        )
    </script>
@endif
@endsection