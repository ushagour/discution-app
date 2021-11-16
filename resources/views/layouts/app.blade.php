<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield("more_css")
    <script src="{{ asset('js/app.js') }}"></script>

    @yield("more_js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @auth
                   <li class="nav-item">
                    <a href="{{route('users.notifications')}}" class="nav-link">
                    <span class="badge badge-info">
                       {{ auth()->user()->unreadNotifications->count()}}
                       unread notifcations
                    </span>

                    </a>
    
                    </li>
                    @endauth
                    <li class="nav-item"><a href="{{route('discussions.index')}}" class="nav-link">Discussion</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- in_array  and request()->path()
        checking if user is visite one of those routes ('login','register','password/reset') dont display the side bare .
        else show it no problem   -->
        @if(!in_array(request()->path(),['login','register','password/reset'])) 
        <main class="container py-4">
            <div class="row">
                <div class="col-md-4">

                @auth       
                <a href="{{route('discussions.create')}}" style="width: 100%;"  class="btn  btn-info my-2">create discussions</a>                       

         @else
         <a href="{{route('login')}}" style="width: 100%;"  class="btn  btn-info my-2">sing in to create discussions</a>                       

        @endauth                           
         <ul class="list-group">

                                @foreach($channels as $channel)
                                <li class="list-group-item">
                                   <a class="link" href="{{route('discussions.index')}}?channel={{$channel->slug}}">{{$channel->name}}</a>   <!-- route discussion.index dosnt have any parametres we have to pass it using ? url  getparams  -->
                                </li>
                                @endforeach


                            </ul>
                    </div>

                

                <div class="col-md-8">
                    @yield('content')

                </div>
            </div>

        </main>
        @else
        <div class="py-2">

            @yield('content')
        </div>
        @endif
    </div>
</body>

</html>
