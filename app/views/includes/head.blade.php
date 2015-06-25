	<meta charset="UTF-8">
	<!-- My Style sheets -->
	{{ HTML::style('_css/style.css') }}
	<!-- View port for responsive design -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('_images/favicon.png') }}" />
	<!-- p5.js -->
	<script language="javascript" type="text/javascript" src="{{ asset('_js/p5.js') }}"></script>
	<script language="javascript" type="text/javascript" src="{{ asset('_js/p5.dom.js') }}"></script>
	<!-- SEO Meta Tags -->
	<meta name="description" content="An easy to online resource specific to fruits and veggies that grow in Florida, with a plant directory, plant lists, garden plotter, tracker and calendar.">
	<meta name="keywords" content="Florida gardening, vegetables, fruit, garden planner, garden plotter, garden search, garden track, edible garden">
	<title>{{$title}}</title>
