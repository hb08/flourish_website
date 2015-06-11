@extends('layouts.master')
@section('content')
{{ Form:: open(array('url'=>'newSearch', 'class'=>'searchForm' )) }}
<div class="row">
	<div class="medium-4 columns medium-offset-4">
		{{ Form::text('search', 'Search by zip code or city') }}
	</div>
	<div class="medium-1 columns end">
		<input type="submit" class="linkButton" />
	</div>
</div>
<div class="row">
	<div class="medium-10 columns medium-offset-1 end">
		<p class="medium-1 columns filterLabel">Filters:</p>
		<div class="medium-11 columns">
			<div class="medium-2 columns">
				<select name="difficulty">
					<option value="">Difficulty</option>
					@foreach($filter['difficulty'] as $d)
						<option value="{{ $d->diff_id }}">{{ucfirst($d->diff_detail)}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="season">
					<option value="">Season</option>
					@foreach($filter['season'] as $s)
						<option value="{{ $s->season_id }}">{{$s->season_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="soil">
					<option value="">Soil</option>
					@foreach($filter['soil'] as $s)
						<option value="{{$s->soil_id }}">{{$s->soil_need}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="sun">
					<option value="">Sun</option>
					@foreach($filter['sun'] as $s)
						<option value="{{$s->sun_id }}">{{$s->sun_need}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="type">
					<option value="">Type</option>
					@foreach($filter['type'] as $t)
						<option value="{{ $t->type_id }}">{{$t->plant_type}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="water">
					<option value="">Water</option>
					@foreach($filter['water'] as $w)
						<option value="{{ $w->water_id }}">{{$w->water_need}}</option>
					@endforeach
				</select>
			</div>
	{{ Form::close() }}
		</div>
	</div>
</div>
<div class="row searchResultInfo">
<p>{{$count}} results for <span>Florida</span></p>
</div>
<div class="row">
	<!-- Add a counter -->
	<?php $counter = 1; ?>
	@foreach($plants as $plant)
	<?php
		$plant_diff = '_images/icons/difficulty/' . $plant->diff_detail . '.png';
  	?>
		@if($counter == $count) <!-- Check if this is the last item using counter -->
			<a class="medium-6 columns plant end " href="details/{{$plant->id}}" >
		@else <!-- Otherewise don't add end class, but do add to counter -->
			<a class="medium-6 columns plant" href="details/{{$plant->id}}" >
			<?php $counter += 1; ?>
		@endif
  		<div class="plantImg medium-3 columns">
			<img src="{{ asset(Plants::getAddress($plant->plant_name, 'main')) }}" alt="{{ $plant->plant_name }}" />
  		</div>
		<div class="plantListing medium-8 columns end">
			<div class="row">
				<h1>{{ $plant->plant_name }}</h1>
			</div>
			<div class="row plantDetails">
				<p class="medium-4 columns">{{ $plant->plant_type }}</p>
				<p class="medium-8 columns difficulty">Difficulty: <img src="{{ asset($plant_diff) }}"</p>
			</div>
			<div class="row plantChart">
				<div class="medium-5 columns">
					<p><span>Sun:</span>{{ $plant->sun_need}}</p>
					<p><span>Season:</span> {{ $plant->season_name}}</p>
					<p><span>Soil:</span> {{ $plant->soil_need}}</p>
				</div>
				<div class="medium-7 columns bottom">
					<p><span>Water:</span> {{ $plant->water_need}}</p>
					<p><span>Harvest Time:</span> {{ $plant->harvest_time }}</p>
				</div>
			</div>
		</div>
	</a>
	@endforeach
</div>



@stop
