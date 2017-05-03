@extends('layouts.master')
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
@section('content')
	<div class="row">
		<h1 class="pageTitle">Garden Overview</h1>
	</div>
	<div class="row iconLinks">
		<div class="medium-2 small-6 medium-offset-2 columns">
			<a href="gp/growing"><span>{{{ $totals['counts']['growing'] or 0 }}}</span>Plants Growing</a>
		</div>
		<div class="medium-2 small-6  columns">
			<a id="lists" href="gp/list"><span>{{{ $totals['counts']['plants'] or 0 }}}</span>Plants List</a>
		</div>
		<div class="medium-2 small-6  columns">
			<a id="gardens" href="gp/gardens"><span>{{{ $totals['counts']['plots'] or 0 }}}</span>Gardens Plotted</a>
		</div>
		<div class="medium-2  small-6 end columns">
			<a id="waiting" href="gp/waiting"><span>{{{ $totals['counts']['waiting'] or 0 }}}</span>Waiting to Grow</a>
		</div>
	</div>
	<div class="row gages">
		<div class="medium-12 columns">
			<h3 class="gageTitle">Plants Growing</h3>
		</div>
@if($totals['counts']['growing'] > 0)
		<p class="show-for-small-only">Access from a larger screen to see your charts</p>
		<div class="medium-3 columns show-for-medium-up" id="waterdial">
				<p id="water" class="hidden">@foreach($totals["water"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
					<p class="dialLabel">Watering Schedule</p>
			<div id="waterchart">
			</div>
		</div>
		<div class="medium-3 columns show-for-medium-up" id="soildial">
				<p id="soil" class="hidden">@foreach($totals["soil"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Soil Type </p>
			<div id="soilchart">
			</div>
		</div>
		<div class="medium-3 columns show-for-medium-up" id="sundial">
				<p id="sun" class="hidden">@foreach($totals["sun"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Sun Needs</p>
			<div id="sunchart">
			</div>
		</div>
		<div class="medium-3 columns show-for-medium-up" id="diffdial">
				<p id="diff" class="hidden">@foreach($totals["diff"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Difficulty Level</p>
			<div id="diffchart">
			</div>
		</div>
@elseif($totals['counts']['growing'] == 0)
		<p>You have 0 plants on your <a href="gp/growing">Growing List.</a> </p>
			<a href="/search" class="linkButton">Add Plants</a>
@endif
		@include('includes.donut_charts')
	</div>
@stop
