@extends('layouts.master')
@section('content')
{{ Form:: open(array('url'=>'newSearch', 'class'=>'searchForm' )) }}
<div class="row">
	<div class="medium-4 columns medium-offset-4">
		<input type="text" placeholder="Search by Zip Code or City" value="{{ $zip }}" name="search" />
	</div>
	<div class="medium-1 columns end">
		<input type="submit" class="linkButton"  />
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
						<option value="{{ $d->diff_id }}"
							<?php
								if(isset($old['diff'])){
									if($d->diff_id == $old['diff']){
										echo 'selected="selected"';
									}
								}
							?>
							>{{ucfirst($d->diff_detail)}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="season">
					<option value="">Season</option>
					@foreach($filter['season'] as $s)
						<option value="{{ $s->season_id }}"
							<?php
								if(isset($old['season'])){
									if($s->season_id == $old['season']){
										echo 'selected="selected"';
									}
								}
							?>
							>{{$s->season_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="soil">
					<option value="">Soil</option>
					@foreach($filter['soil'] as $s)
						<option value="{{$s->soil_id }}"
							<?php
								if(isset($old['soil'])){
									if($s->soil_id == $old['soil']){
										echo 'selected="selected"';
									}
								}
							?>
						>{{$s->soil_need}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="sun">
					<option value="">Sun</option>
					@foreach($filter['sun'] as $s)
						<option value="{{$s->sun_id }}"
							<?php
								if(isset($old['sun'])){
									if($s->sun_id == $old['sun']){
										echo 'selected="selected"';
									}
								}
							?>
						>{{$s->sun_need}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="type">
					<option value="">Type</option>
					@foreach($filter['type'] as $t)
						<option value="{{ $t->type_id }}"
							<?php
								if(isset($old['type'])){
									if($t->type_id== $old['type']){
										echo 'selected="selected"';
									}
								}
							?>
						>{{$t->plant_type}}</option>
					@endforeach
				</select>
			</div>
			<div class="medium-2 columns">
				<select name="water">
					<option value="">Water</option>
					@foreach($filter['water'] as $w)
						<option value="{{ $w->water_id }}"
							<?php
								if(isset($old['water'])){
									if($w->water_id == $old['water']){
										echo 'selected="selected"';
									}
								}
							?>
						>{{$w->water_need}}</option>
					@endforeach
				</select>
			</div>
	{{ Form::close() }}
		</div>
	</div>
</div>
<div class="row searchResultInfo">
<p>{{$count}} results for <span>{{$zip}}</span></p>
</div>
<div class="row">
	<div class="row">
	<!-- Add a counter -->
	<script>
		document.getElementbyId
	</script>
	<?php $counter = 1; ?>
	@foreach($plants as $plant)
	<?php
			$plant_diff = '_images/icons/difficulty/' . $plant->diff_detail . '.png';
  	?>
			<div class="medium-6 columns plant" >
				@if(User::checkPlant($plant->id))
					<a href="#" class="ar remove plantRemove" data-reveal-id="searchRemove" id="{{$plant->id}}" name="{{$plant->plant_name}}">Remove Plant</a>
				@else
					<a href="#" class="ar add plantAdd" data-reveal-id="searchAdd" id="{{$plant->id}}" name="{{$plant->plant_name}}">Add Plant</a>
				@endif
				<a href="details/{{$plant->id}}">
		  		<div class="plantImg medium-3 columns">
					<img src="{{ asset(Plants::getAddress($plant->plant_name, 'main')) }}" alt="{{ $plant->plant_name }}| Flourish – Your Florida Gardening Guide" />
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
								<p><span>Season:</span>{{ $plant->season_name}}</p>
								<p><span>Soil:</span>{{ $plant->soil_need}}</p>
							</div>
							<div class="medium-7 columns bottom rightCol">
								<p><span>Water:</span>{{ $plant->water_need}}</p>
								<p><span>Harvest Time:</span>{{ $plant->harvest_time }}</p>
							</div>
						</div>
					</div>
				</a>
		</div>
			<!-- End row if Even -->
			@if($counter %2 == 0)
				</div>
				<!-- If this is not the last item add new row -->
				@if($counter != $count )
					<div class="row">
				@endif
			<!-- If Last Item and Odd, end row div -->
			@elseif($counter % 2 == 1 && $counter == $count)
				</div>
			@endif
			<?php $counter += 1; ?>
	@endforeach
</div>
@include('includes/addRemovePanels')
@stop
