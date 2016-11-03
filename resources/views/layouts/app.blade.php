<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ $page_title or  config('app.name')}}</title>

    <!-- jQuery -->
    <script src="{!! secure_asset('assets/js/jquery.min.js')!!}"></script>

    <!-- Bootstrap -->
    <script src="{{ secure_asset('assets/js/bootstrap.min.js')}}"></script>
    <link href="{{ secure_asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap.min.css')  }} ">

    <!-- Custom styles for this template -->
    <link href="{{ secure_asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ secure_asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{ secure_asset('assets/js/respond.min.js')}}'"></script>
    <![endif]-->

    @yield('header_js')
    @yield('header_css')
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header navbar-header-add">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ secure_url('/') }}"><img style="width: 60px;margin-top: -5px;" src="{!! secure_asset('assets/images/Sonic-20160916-logo.min.png') !!}"></a>
            @if(Auth::check()) <span class="navbar-header-child">Balch Conference</span> @endif
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    @if(!Request::is('login'))
                        <li><a href="{{ secure_url('login') }}">Login</a></li>
                    @endif
                @else

                    <li><a href="{{ secure_url('profile') }}"><img src="{{secure_url('avatar/'.Auth::user()->id.'/'.Auth::user()->avatar)}}" class="profile_pic"/> {{ ucwords(Auth::user()->firstname.' '.Auth::user()->lastname)}}</a></li>
                    {{--<li><a href="javascript:void(0)"><img src="{!! secure_asset('assets/images/man-silhouette1.png') !!}" style="width:19px;height:19px" class="profile_pic"/> {{ Auth::user()->name }}</a></li>--}}
                    <li><a href="{{ secure_url('/') }}">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu</a>
                        <ul class="dropdown-menu arrow_box" role="menu">
                            <li class="dropdown"><a href="{!! url('events/create') !!}"><span class="glyphicon glyphicon-book"></span> Book Conference</a></li>
                            <li><a href="{{ secure_url('events') }}"><span class="glyphicon glyphicon-th-list"></span> Event List</a></li>
                            <li><a href="{{ secure_url('calendar') }}"><span class="glyphicon glyphicon-calendar"></span> Calendar</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ secure_url('contacts') }}"><span class="glyphicon glyphicon-list-alt"></span> Contacts</a></li>
                            <li><a href="{{ secure_url('settings')}}"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ secure_url('contactUs') }}"><span class="glyphicon glyphicon-phone"></span> Contact Us</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ secure_url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div> <!-- /container -->

<footer class="footer">
    <p>March 2016 &copy; Copyright</p>
    <p><a href="{!! secure_url('disclaimer') !!}">Balch Conference</a> &#x25cf; <a href="{!! secure_url('technical_support') !!}">Technical Support</a></p>
    <p>Version 1.0.0</p>
</footer>
@yield('modal')
@yield('footer_js')
</body>
</html>