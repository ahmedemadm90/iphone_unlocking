<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="Ultra Palestine - Register">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" class="rounded-circle"
        href="https://d1nxzqpcg2bym0.cloudfront.net/google_play/com.dcunlocker.xiaomifrp/f12df1d0-dbcf-11e9-810a-7127bff8fa97/128x128" />

    <!-- TITLE -->
    <title>FRP Unlocker - Register</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet" />
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/colors/color1.css') }}" />
</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">
        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->
        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <div class="col col-login mx-auto mt-7">
                            <div class="text-center">
                                <img src="https://d1nxzqpcg2bym0.cloudfront.net/google_play/com.dcunlocker.xiaomifrp/f12df1d0-dbcf-11e9-810a-7127bff8fa97/128x128"
                                    class="rounded-circle" width="100" height="100" alt="" class="">
                            </div>
                        </div>
                        <hr>
                        <form class="login100-form validate-form" method="POST" action="{{ route('doregister') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('layouts.errors')
                            @include('layouts.sessions')
                            <span class="login100-form-title pb-5">
                                Join Us To Start Your Journey
                            </span>
                            <div class="panel panel-primary">
                                <div class="row">
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <input required class="input100 border-start-0 form-control ms-0"
                                                type="text" placeholder="First Name" name="name">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </a>
                                            <input required class="input100 border-start-0 form-control ms-0"
                                                type="number" placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </a>
                                            <input required class="input100 border-start-0 form-control ms-0"
                                                type="email" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <input required class="input100 border-start-0 form-control ms-0"
                                                type="password" placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <input required class="input100 border-start-0 form-control ms-0"
                                                type="password" placeholder="Confirm Password"
                                                name="confirm_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md col-lg">
                                        <div class="wrap-input100 validate-input input-group">
                                            <a class="input-group-text bg-white text-muted">
                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="text"
                                                placeholder="country" name="country">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md text-center">
                                        <button class="btn btn-success m-auto">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">Have Account ?<a href="{{ route('login') }}"
                                            class="text-primary ms-1">Login</a></p>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('assets/js/show-password.min.js') }}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ asset('assets/js/generate-otp.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
