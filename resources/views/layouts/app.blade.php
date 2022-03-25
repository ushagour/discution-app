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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
        rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/magnific-popup/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />
    @yield('more_css')


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme.css')}}" />
    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/pnotify/pnotify.custom.css')}}" />


    <!-- toastr -->
    <!-- <script src="{{ asset('js/toastr.js') }}"></script>
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"> -->
    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/skins/default.css')}}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/stylesheets/theme-custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('assets/vendor/modernizr/modernizr.js')}}"></script>




</head>

<body>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="../" class="logo">
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened"
                        data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </a>
            </div>

            <!-- start: search & user box -->
            <div class="header-right">



                <form class="search nav-form" method="GET" action="{{route('Search')}}">
                    <div class="input-group input-search">
                        <input type="text" class="form-control" name="query" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>

                <span class="separator"></span>

                @auth
                <ul class="notifications">
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="badge">
                                {{ auth()->user()->unreadNotifications->count()}}

                            </span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default">
                                    {{ auth()->user()->unreadNotifications->count()}}</span>
                                Notifications </div>

                            <div class="content">
                                <ul>
                                    @foreach(auth()->user()->notifications()->get() as $notification)
                                    <!-- $notification->type == 'App\Notifications\NewReplyAdded' -->
                                    @if( $notification->unread() )


                                    <li>
                                        <a href="{{route('discussions.show',$notification->data['discussion']['slug'])}}"
                                            class="clearfix">
                                            <!-- <figure class="image">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure> -->
                                            <span class="title"> A new replay was added to your discussions
                                            </span>
                                            <span class="message"> {{$notification->created_at->diffForHumans()}}
                                            </span>
                                        </a>
                                    </li>


                                    @endif


                                    @endforeach

                                </ul>

                                <hr />

                                <div class="text-right">
                                    <a href="{{route('users.notifications')}}" class="view-more">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                @endauth

                <span class="separator"></span>

                <div id="userbox" class="userbox">


                    <!-- Authentication Links  -->
                    @guest
                    @if (Route::has('login'))
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                    <br>
                    @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            @if(Auth::user()->profile->avatar)
                            <img src="{{Auth::user()->profile->avatar}}" alt="{{Auth::user()->name}}"
                                class="img-circle" data-lock-picture="src={{Auth::user()->profile->avatar}}" />
                                @else
                                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="{{Auth::user()->name}}"
                                class="img-circle" data-lock-picture="src={{ Gravatar::src(Auth::user()->email) }}" />
                                @endif
                        </figure>
                        <div class="profile-info" data-lock-name="{{Auth::user()->name}}"
                            data-lock-email="{{Auth::user()->email}}">
                            <span class="name"> {{ Auth::user()->name }}</span>
                            <span class="role">administrator</span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('user.show',['user'=>Auth::user()]) }}"><i
                                        class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{route('home')}}?filters=me"><i
                                        class="fa  fa-inbox"></i> My discussions</a>
                            </li>



                            <li>
                                <a role="menuitem" tabindex="-1" href="{{route('lockscreen')}}"><i
                                        class="fa fa-lock"></i> Lock Screen</a>
                            </li>
                            <li>
                                <a role="menuitem" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>


                    @endguest





                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">

                <div class="sidebar-header">
                    <div class="sidebar-title">
                        Navigation
                    </div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                        data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li>
                                    <a href="{{route('discussions.index')}}">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Discussions</span>

                                    </a>

                                </li>
                                <li>
                                    @auth
                                    <a href="{{route('discussions.create')}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span>create discussions</span>
                                    </a>

                                    <a href="{{route('channel.index')}}">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        <span> Channels </span>

                                    </a>
                                    <a href="{{route('user.index')}}">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span> Users Manage </span>

                                    </a>



                                    @else
                                    <a href="{{route('login')}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span>sing in to create discussions</span>
                                    </a>


                                    @endauth
                                </li>


                            </ul>
                        </nav>

                        <hr class="separator" />

                        <div class="sidebar-widget widget-tasks">
                            <div class="widget-header">
                                <h6>Channels</h6>
                                <div class="widget-toggle">+</div>
                            </div>
                            <div class="widget-content">
                                <ul class="list-unstyled m-none">
                                    @foreach($channels as $channel)

                                    <li><a
                                            href="{{route('discussions.index')}}?channel={{$channel->slug}}">{{$channel->name}}</a>
                                    </li>

                                    @endforeach

                                </ul>

                            </div>
                        </div>

                        <hr class="separator" />

                    </div>

            </aside>
            <!-- end: sidebar -->


            <section role="main" class="content-body">
                @yield('header')

                @yield('content')

                <!-- start: page -->
                <!-- end: page -->
            </section>
        </div>
        </div>

        <aside id="sidebar-right" class="sidebar-right">
            <div class="nano">
                <div class="nano-content">
                    <a href="#" class="mobile-close visible-xs">
                        Collapse <i class="fa fa-chevron-right"></i>
                    </a>

                    <div class="sidebar-right-wrapper">

                        @guest
                        <!-- // The user is not authenticated...s -->
                        <section class="panel">
                            <header class="panel-heading bg-dark">
                                <div class="panel-heading-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                            </header>
                            <div class="panel-body text-center">
                                <h3 class="text-semibold mt-sm text-center">JOIN OUR COMMUNITY</h3>
                                <p class="text-center">Create your account now
                                    <a href="{{ route('register') }}" class="mb-xs mt-xs mr-xs btn btn-dark "> Regestre
                                    </a>
                                </p>
                            </div>
                        </section>
                        @endguest

                        
                        <div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
                                <ul class="simple-user-list">
                                            @foreach(App\Models\User::all()  as $topuser)
                                                @if($topuser->profile->point >= 100)
                                                <li>
												<figure class="image rounded">
													<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
												</figure>
												<span class="title">Joseph Doe Junior</span>
												<span class="message truncate">Lorem ipsum dolor sit.</span>
											</li>
                                                @endif
                                            @endforeach
								</ul>
							</div>


                     
                               
                    </div>
                </div>
            </div>
        </aside>
    </section>
</body>

<!-- Vendor -->
<script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
@yield("more_js")

<script src="{{asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/magnific-popup/magnific-popup.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
<!-- Specific Page Vendor -->
<script src="{{asset('assets/vendor/pnotify/pnotify.custom.js')}}"></script>


<!-- Theme Base, Components and Settings -->
<script src="{{asset('assets/javascripts/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('assets/javascripts/theme.custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('assets/javascripts/theme.init.js')}}"></script>
<!-- Notifications -->
<script src="{{asset('assets/javascripts/ui-elements/examples.notifications.js')}}"></script>





<script>
    @if(Session::has('toaster-message'))
    new PNotify({
        title: '{{ Session::get('
        toaster - message ') }}',
        text: 'Check me out! I\'m a notice.',
        type: 'custom',
        addclass: '{{ Session::get('
        toaster - class ') }}',
        icon: 'fa fa-twitter'
    });
    @endif

</script>



</html>
