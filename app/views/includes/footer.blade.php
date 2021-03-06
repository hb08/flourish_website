<footer>
	<p class="center">Copyright &copy; 2015 BetaCode</p>
	<p class="center">Plant information from <a href="http://www.almanac.com/">The Old Farmer's Almanac</a>, <a href="http://www.motherearthnews.com/organic-gardening/vegetables.aspx">Mother Earth News</a>, and <a href="http://www.gardening.cornell.edu/homegardening/">Cornell University</a> </p>
</footer>

<!-- Foundation -->
<script type="text/javascript" src="{{ asset('_js/foundation.min.js') }}"></script>
<script>
	$(document).foundation();
</script>
<!-- Page Dependent Inclusions -->
@if(!empty($totals))
	<!-- Arc Text -->
	<script type="text/javascript" src="{{ asset('_js/jquery.arctext.js') }}"></script>
@else
	<!-- Slick -->
	<script type="text/javascript" src="{{ asset('_js/slick.js') }}"></script>
@endif

<!-- My Scripts-->
<script type="text/javascript" src="{{ asset('_js/scripts.js') }}"></script>
