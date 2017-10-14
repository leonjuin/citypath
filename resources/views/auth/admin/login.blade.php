<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} | Login</title>

    <link href="/assets/images/favicons/apple-icon-144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="/assets/images/favicons/apple-icon-114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="/assets/images/favicons/apple-icon-72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="/assets/images/favicons/apple-icon-57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="/assets/images/favicons/favicon.png" rel="icon" type="image/png">
    <link href="/templates/lotus/assets/images/favicon.png" rel="shortcut icon">

    <link rel="stylesheet" type="text/css" href="/assets/css/admin/vendor.css">
    <link rel="stylesheet" type="text/css" href="/templates/cleanui/assets/common/css/source/main.css">
    <style type="text/css">
        .social-container .btn i.fa-facebook-official{ color: #3b5998!important; }
        .social-container .btn i.fa-google-plus-square{ color: #d34836!important; }
        body.single-page .single-page-block .form-actions a:hover{ text-decoration: none; }
        div.single-page-login-beta .single-page-block .single-page-block-inner{ height: 600px }
    </style>
</head>
<body class="theme-default">

<section class="page-content">
<div class="page-content-inner single-page-login-beta" style="background-image:  url('../assets/images/admin/background.jpg'); background-position: center;">

    <!-- Login Beta Page -->
    <div class="single-page-block">
        <div class="row">
            <div class="col-xl-12">
                <div class="single-page-block-inner">
                    <div class="single-page-block-form">

                        <h3 class="text-center">                            
                            <img src="/templates/lotus/assets/images/logo-header.png"/>
                            <span class="small">2017</span>
                        </h3>
                        <br />
                        <form id="form-validation" name="form-validation" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input id="validation-email"
                                       class="form-control"
                                       placeholder="Username"
                                       name="username"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input id="validation-password"
                                       class="form-control password"
                                       name="password"
                                       type="password" data-validation="[L>=6]"
                                       data-validation-message="$ must be at least 6 characters"
                                       placeholder="Password">
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary width-150 margin-inline">Sign In</button>
                            </div>
                            <div class="form-group">
                                <div class="social-login">
                                    <span class="title">
                                        Use another service to Log In
                                    </span>
                                    <div class="social-container">
                                        <a href="/auth/facebook?callback=login" class="btn btn-icon">
                                            <i class="fa fa-3x fa-facebook-official" aria-hidden="true"></i>
                                        </a>
                                        <a href="/auth/google?callback=login" class="btn btn-icon">
                                            <i class="fa fa-3x fa-google-plus-square" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="single-page-block-sidebar" style="background-color:dimgrey;">
                        <div class="single-page-block-sidebar--shadow"><!-- --></div>
                        <div class="single-page-block-sidebar--content">
                            <div class="single-page-block-sidebar--content--title">
                                Admin Panel
                            </div>
                            <div class="single-page-block-sidebar--content--item">
                                Please take responsibility of what you do as admin.
                            </div>
                            <div class="single-page-block-sidebar--content--item">
                                IP: {{Request::ip()}}
                            </div>
                        </div>
                        <div class="single-page-block-sidebar--place">
                            <i class="icmn-location margin-right-5"><!-- --></i>
                            Powered by Dynamic Function Tech
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Beta Page -->

</div>

<!-- Page Scripts -->

<script src="/assets/js/admin/vendor.js"></script>
<script src="/templates/cleanui/assets/common/js/common.js"></script>
<script>
    $(function() {

        // Add class to body for change layout settings
        $('body').addClass('single-page');

        // Form Validation
        $('#form-validation').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>