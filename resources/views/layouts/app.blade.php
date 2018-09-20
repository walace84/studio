<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Diones - Studio</title>

  <link rel="icon" type="image/png" href="{{url('img/icon.png')}}" />  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{url('css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{url('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>


</head>
<body>



        <nav class="brown darken-3" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="{{route('index')}}" class="brand-logo"><img src="{{url('img/logo.png')}}" width="70px" height="60px"></a>
            <ul class="right hide-on-med-and-down">

            @guest
                <li><a href="{{ route('login') }}">Entrar</a></li>
            @else
                <li><a href="{{route('home')}}">Painel</a></li>
                <li><a href="#">{{ ucwords(Auth::user()->name) }}</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
      
            </ul>

            <ul id="nav-mobile" class="sidenav">
            @guest
                <li><a href="{{ route('login') }}">Entrar</a></li>
            @else
                <li><a href="#!">{{ Auth::user()->name }}</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>




       <div class="container">
       @yield('content')
       </div>

       @stack('scripts')


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{url('js/materialize.js')}}"></script>
    <script src="{{url('js/init.js')}}"></script>
    <script src="{{url('js/style.js')}}"></script>

</body>
</html>
