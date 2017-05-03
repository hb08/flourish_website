<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    <div class="row">
       <header>
            @include('includes.header')
       </header>
    </div>
    <div class="row">
	    <nav>
	    	@include('includes.nav')
		</nav>
    </div>
    <div class="row">
            @yield('content')
    </div>
    @if(Session::has('user'))
      @include('includes.account')
    @else
      @include('includes.login')
    @endif
    <div>
    		 @include('includes.footer')
    </div>
</body>
</html>
