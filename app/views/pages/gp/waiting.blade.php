@extends('layouts.master_panel')
@section('content')
	<div class="row panel-nav">
		<ul class="medium-6 columns medium-centered">
			<li class="medium-3 columns"><a href="growing">Growing</a></li>
			<li class="medium-3 columns listed"><a href="list">Listed</a></li>
			<li class="medium-3 columns gardens"><a href="gardens">Gardens</a></li>
			<li class="medium-3 columns waiting  selected"><a href="waiting">Waiting</a></li>
		</ul>
	</div>
	<div class="row panel-content">
		<h1>Plants Waiting</h1>
		<div class="row medium-collapse">
			<div class="medium-3 columns side-bar">
				<ul class="medium-12 columns">
					@foreach($plants as $plant)
							<!-- If $thisPlant exsits, and is the same as this number -->
							@if(isset($thisPlant) && $thisPlant == $plant->plant_id)
								<li class="selected">
							@else
								<li>
							@endif
							<a href="view/waiting/{{$plant->plant_id}}">
								<img src="{{asset(Plants::getAddress($plant->plant_name, 'main'))}}" alt="{{$plant->plant_name}}" />
								{{$plant->plant_name}}
							</a>
							<a href="/remove/waiting/{{$plant->plant_id}}" class="delete">X</a>
						</li>
					@endforeach
				</ul>
				<a href="#" class="linkButton">Add Plants</a>
			</div>
			@foreach($plants as $plant)
				@if(isset($thisPlant) && $thisPlant == $plant->plant_id)
			<div class="medium-9 columns end panel-page">
					<div class="row">
						<h2>{{$plant->plant_name}}</h2>
					</div>
					<div class="row">
						<figure class="medium-2 columns">
							<img src="{{ asset( Plants::getAddress($plant->plant_name, 'seed') ) }}" alt="{{ $plant->plant_name}} Seed" />
								@if(isset($plant->seed_src))
									<figcaption>
										Image by {{ $plant->seed_src }}
									</figcaption>
								@endif
						</figure>
						<figure class="medium-2 columns">
								<img src="{{ asset( Plants::getAddress($plant->plant_name, 'sprout') ) }}" alt="{{ $plant->plant_name}} Sprout" />
									@if(isset($plant->sprout_src))
										<figcaption>
											Image by {{ $plant->sprout_src }}
										</figcaption>
									@endif
						</figure>
						<figure class="medium-2 columns end">
								<img src="{{ asset( Plants::getAddress($plant->plant_name, 'harvest') ) }}" alt="{{ $plant->plant_name}} Harvest" />
									@if(isset($plant->harvest_src))
										<figcaption>
											Image by {{ $plant->harvest_src }}
										</figcaption>
									@endif
						</figure>
					</div>
						<div class="row chart medium-collapse">
							<div class="medium-3 columns">
								<p><span class="spaced">Sun:</span>{{ $chart->sun_need}}</p>
								<p><span class="spaced">Season:</span>{{ $chart->season_name}}</p>
								<p><span class="spaced">Soil:</span>{{ $chart->soil_need}}</p>
							</div>
							<div class="medium-9 columns">
								<p>Difficulty: <span><img src="{{asset('_images/icons/difficulty/' . $chart->diff_detail . '.png') }}" alt="{{$chart->diff_detail}}" class="diffStars"/></span></p>
								<p><span class="spaced">Water:</span>{{ $chart->water_need}}</p>
								<p><span class="spaced">Harvest Time:</span>{{ $chart->harvest_time }}</p>
							</div>
					</div>
					<div class="row gi">
						<h4>Prep Information</h4>
						<p class="text-left">
							{{$info}}
						</p>
					</div>
					<div class="row linking text-right">
						<a href="../details/{{$plant->plant_id}}" alt="{{ $plant->plant_name }}">More Details</a>
					</div>
			@endif
		@endforeach
			</div><!-- End Panel Page -->
		</div>
	</div> <!-- End Panel Content -->
@stop