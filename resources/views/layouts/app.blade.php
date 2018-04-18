<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{-- config('app.name', 'Laravel') --}}</title>

    @section('link')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @show

    @section('style')
    @show
	
   <style type="text/css">
		html {
		  height: 100%;
		  box-sizing: border-box;
		}
		
		*,
		*:before,
		*:after {
		  box-sizing: inherit;
		}

		body {
		  position: relative;
		  margin: 0;
		  padding-bottom: 4rem;
		  min-height: 100%;
		}
		
		#copyright {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		  padding: 0.5rem;
		  background-color: #e7e7e7;
		  text-align: center;			
		}
  </style>		

	  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117531393-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-117531393-2');
	</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
						@yield('navbar-brand')
                        {{-- config('app.name', 'Laravel') --}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
						@auth
							@yield('left-menu')
						@endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
							<li><a href="{{ route('contact.getForm') }}">Контакт</a></li>						
                            <li><a href="{{ route('login') }}">Логин</a></li>
                            <li class="disabled"><a href="{{ route('register') }}">Регистрация</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    @section('script')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    @show

    <script>
        $(document).ready(function() {
           $(".nav li.disabled a").click(function() {
             return false;
           });
        });            
    </script>
	
    @section('footer')
		<div id="copyright">&nbsp;&nbsp;© Copyright 2018 All rights reserved</div>
    @show		
</body>
</html>
