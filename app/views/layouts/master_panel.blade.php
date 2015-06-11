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
	    	@include('includes.nav_secondary')
		    </nav>
    </div>
    <div class="row panel">
            @yield('content')
    </div>
    <div class="row">
    		 @include('includes.footer')
    </div>
</body>
</html>
