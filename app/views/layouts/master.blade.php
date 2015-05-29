<!DOCTYPE HTML>
<html lang="en">
<head>
    @include('includes.head')    
</head>
<body>
    <div>
       <header>
            @include('includes.header')
       </header>
    </div>
    <div class="pure-g">
	    <nav class="pure-u-20-24 offset-md-1-12">
	    	@include('includes.nav')	
		</nav>    	
    </div>
    <div class="pure-g">
            @yield('content')
    </div>
    <div>
    		 @include('includes.footer')    	
    </div>
</body>
</html>