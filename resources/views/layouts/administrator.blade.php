<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('img/logo-fav.png')}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/jqvmap/jqvmap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css"/>
    @yield('css')
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="#" class="navbar-brand"></a></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="
                @if (is_null($user->avatar))
                  {{asset('storage/images/avatar/default.png')}}
                @else
                  {{asset('storage/images/avatar/'.$user->avatar)}}
                @endif
                " alt="Avatar"><span class="user-name">{{$user->nama}}</span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name">{{$user->name}}</div>
                      <div class="user-position online">Administrator</div>
                    </div>
                  </li>
                  <li><a href="{{route('administrator.profile')}}"><span class="icon mdi mdi-face"></span> Profile</a></li>
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Menu</li>
                  <li class="@yield('dashboard')"><a href="{{route('administrator.dashboard')}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                  </li>
                  <li class="@yield('perhitungan')"><a href="{{route('administrator.dataset')}}"><i class="icon mdi mdi-assignment"></i><span>Perhitungan</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">

          @yield('content')

      </div>
    </div>
    <script src="{{asset('lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/jquery.gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
    @yield('js')
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();

      });
    </script>
  </body>
</html>
