@extends('layouts.master')
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
@section('content')
	<div class="row">
		<h1 class="pageTitle">Garden Overview</h1>
	</div>
	<div class="row iconLinks">
		<div class="medium-2 medium-offset-2 columns">
			<a href="gp/growing"><span>{{{ $totals['counts']['growing'] or 0 }}}</span>Plants Growing</a>
		</div>
		<div class="medium-2 columns">
			<a id="lists" href="gp/list"><span>{{{ $totals['counts']['plants'] or 0 }}}</span>Plants List</a>
		</div>
		<div class="medium-2 columns">
			<a id="gardens" href="gp/gardens"><span>{{{ $totals['counts']['plots'] or 0 }}}</span>Gardens Plotted</a>
		</div>
		<div class="medium-2 end columns">
			<a id="waiting" href="gp/waiting"><span>{{{ $totals['counts']['waiting'] or 0 }}}</span>Waiting to Grow</a>
		</div>
	</div>
	<div class="row gages">
		<div class="medium-12 columns">
			<h3 class="gageTitle">Totals From All Lists</h3>
		</div>
		<div class="medium-3 columns">
			@if($totals)
				<p id="water" class="hidden">@foreach($totals["water"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Watering Schedule</p>
			@endif
			<div id="waterchart">
			</div>
		</div>
		<div class="medium-3 columns">
			@if($totals)
				<p id="soil" class="hidden">@foreach($totals["soil"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Soil Type </p>
			@endif
			<div id="soilchart">
			</div>
		</div>
		<div class="medium-3 columns">
			@if($totals)
				<p id="sun" class="hidden">@foreach($totals["sun"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Sun Needs</p>
			@endif
			<div id="sunchart">
			</div>
		</div>
		<div class="medium-3 columns">
			@if($totals)
				<p id="diff" class="hidden">@foreach($totals["diff"] as $id => $need){{$id}},{{$need}}|@endforeach</p>
				<p class="dialLabel">Difficulty Level</p>
			@endif
			<div id="diffchart">
			</div>
		</div>
		@include('includes.donut_charts')
	</div>
@stop
