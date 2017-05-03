@extends('layouts.master_sub')
@section('content')
	<div class="row detailsChart">
		<div class="detailsImg medium-3 columns medium-offset-2">
			<img src="{{asset($img)}}" alt="{{$chart->plant_name}}| Flourish – Your Florida Gardening Guide"/>
			@if(User::checkPlant($chart->id))
				<div class="medium-12 columns">
					<a href="#" data-reveal-id="detailsRemove">Remove From Lists</a>
				</div>
			@elseif(Session::get('user'))
				<div class="medium-12 columns">
					<a href="#" data-reveal-id="detailsAdd">Add To Lists</a>
				</div>
			@endif
		</div>
		<div class="charts medium-7  columns end">
			<div class="row">
				<h1>{{$chart->plant_name}}</h1>
			</div>
			<div class="tech row">
				<p class="medium-4 small-4 columns">{{$chart->bot_name}}</p>
				<p class="medium-4 small-4 columns">{{$chart->plant_type}}</p>
				<p class="medium-4 small-4 columns">Difficulty: <img src="{{$diff}}" alt="{{$diff}}" class="diffStars"/></p>
			</div>
			<div class="row chart">
				<div class="medium-5 small-5 columns">
					<p><span class="spaced">Sun:</span>{{ $chart->sun_need}}</p>
					<p><span class="spaced">Season:</span>{{ $chart->season_name}}</p>
					<p><span class="spaced">Soil:</span>{{ $chart->soil_need}}</p>
				</div>
				<div class="medium-7 small-7 columns bottom">
					<p><span class="spaced">Water:</span>{{ $chart->water_need}}</p>
					<p><span class="spaced">Harvest Time:</span>{{ $chart->harvest_time }}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="medium-2 columns toc show-for-medium-up">
			<ul>
				<li class="descrip"><a href="#description">Plant Description</a></li>
				<li class="prep"><a href="#prep">Preparation</a></li>
				<li class="plant"><a href="#planting">Planting</a></li>
				<li class="care"><a href="#care">Care</a></li>
				<li class="harvest"><a href="#harvest">Harvest</a></li>
			</ul>
		</div>
		<div class="medium-9 columns copyText">
			<h3 id="description">Plant Description</h3>
			<p>{{$info->plant_descrip}}</p>
			<hr>
			<h3 id="prep">Preparation</h3></h2>
			<p>{{$info->plant_prep}}</p>
			<h4 id="soil">Soil Needs</h4>
			<p>{{$info->soil_needs}}</p>
			<hr>
			<h3 id="planting">Planting</h3>
			<p>{{$info->planting}}</p>
			<div class="row">
				<p class="medium-2 columns">Depth: {{$info->seed_depth}}</p>
				<p class="medium-3 columns end">Spacing: {{$info->plant_space}}</p>
			</div>
			<hr>
			<h3 id="care">Care</h3>
			<p>{{$info->care}}</p>
			<hr>
			<h3 id="harvest">Harvest</h3>
			<p>{{$info->harvest}}</p>
			<hr>
		</div>
	</div>
	@include('includes/addRemovePanels')
@stop
