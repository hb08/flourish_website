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
    <div class="row">
            @yield('content')
    </div>
    <div>
    		 @include('includes.footer')    	
    </div>
</body>
</html>