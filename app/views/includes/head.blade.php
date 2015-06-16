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
	<title>{{$title}}</title>
