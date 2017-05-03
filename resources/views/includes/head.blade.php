	<meta charset="UTF-8">
	<!-- My Style sheets -->
	{{--{{ HTML::style('_css/style.css') }}--}}
	<link rel="stylesheet" href="_css/style.css">
	<!-- View port for responsive design REMOVED until mobile update at later date -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('_images/favicon.png') }}" />
	<!-- SEO Meta Tags -->
	<meta name="description" content="An easy to online resource specific to fruits and veggies that grow in Florida, with a plant directory, plant lists, garden plotter, tracker and calendar.">
	<meta name="keywords" content="Florida gardening, vegetables, fruit, garden planner, garden plotter, garden search, garden track, edible garden">
	<title>{{$title}}</title>
	<script type="text/javascript" src="{{ asset('_js/vendor/modernizr.js') }}"></script>
	@if(!empty($plants) || !empty($size))
		<!-- p5.js -->
		<script language="javascript" type="text/javascript" src="{{ asset('_js/p5.js') }}"></script>
		<script language="javascript" type="text/javascript" src="{{ asset('_js/p5.dom.js') }}"></script>
	@endif
	<!-- jQuery -->
	<script type="text/javascript" src="{{ asset('_js/vendor/jquery.js') }}"></script>
	<!-- Google Analytics Tracking -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-65756378-1', 'auto');
	ga('send', 'pageview');

	</script>
