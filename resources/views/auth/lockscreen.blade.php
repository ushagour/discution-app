<!doctype html>
<html class="fixed">

<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Blank Page | SHARED ON THEMELOCK.COM</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SCRIPTS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>    -->

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/magnific-popup/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
        integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/skins/default.css') }}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme-custom.css') }}">

    <!-- Head Libs -->
    <script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>
</head>

<body>
    <!-- start: page -->
    <section class="body-sign body-locked">
        <div class="center-sign">
            <div class="panel panel-sign">
                <div class="panel-body">

                    <form method="POST" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">
                        @csrf



                        <div class="current-user text-center">
                            <img src="assets/images/!logged-user.jpg" alt="John Doe" class="img-circle user-image" />
                            <h2 class="user-name text-dark m-none">{{Auth::user()->name}}</h2>
                            <p class="user-email m-none">{{Auth::user()->email}}</p>
                        </div>
                        @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group mb-lg">
                            <div class="input-group input-group-icon">
                                <input id="pwd" type="password" name="password" class="form-control input-lg"
                                    placeholder="Password" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p class="mt-xs mb-none">
                                    <!-- <a href="#">Not John Doe?</a> -->
                                </p>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="submit" class="btn btn-primary">Unlock</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end: page -->

    <!-- Vendor -->
    <script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/vendor/magnific-popup/magnific-popup.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js')}}"
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <!-- Theme Base, Components and Settings -->
    <script src="{{asset('assets/javascripts/theme.js')}}"></script>

    <!-- Theme Custom -->
    <script src="{{asset('assets/javascripts/theme.custom.js')}}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{asset('assets/javascripts/theme.init.js')}}"></script>




</body>

</html>
