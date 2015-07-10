@extends('layouts.master_panel')
@section('content')
	<div class="row panel-nav">
		<ul class="medium-6 columns medium-centered">
			<li class="medium-3 columns"><a href="growing"><span class="hideWords">Growing</span><span class="showNumbers">{{$totals['counts']['growing']}}</span></a></li>
			<li class="medium-3 columns listed  selected"><a href="list"><span class="hideWords">Listed</span><span class="showNumbers">{{$totals['counts']['plants']}}</span></a></li>
			<li class="medium-3 columns gardens"><a href="gardens"><span class="hideWords">Gardens</span><span class="showNumbers">{{$totals['counts']['plots']}}</span></a></li>
			<li class="medium-3 columns waiting"><a href="waiting"><span class="hideWords">Waiting</span><span class="showNumbers">{{$totals['counts']['waiting']}}</span></a></li>
		</ul>
	</div>
	<div class="row panel-content listings">
		<h1>Plants List</h1>
		<!-- Add a counter -->
		<?php $counter = 1; ?>
		@foreach($lists as $list)
			<?php
				$list_diff = '_images/icons/difficulty/' . $list->diff_detail . '.png';
	  	?>
			@if($counter == $count) <!-- Check if this is the last item using counter -->
				<div class="medium-6 columns plant end " href="../details/{{$list->id}}" >
	  	@else <!-- Otherewise don't add end class, but do add to counter -->
				<div class="medium-6 columns plant" href="../details/{{$list->id}}" >
					<?php $counter += 1; ?>
			@endif
					<a href="#"  class="ar remove plantRemove" data-reveal-id="listRemove" id="{{$list->id}}" name="{{$list->plant_name}}">Remove From List</a>
					<a href="../details/{{$list->id}}" >
		  		<div class="plantImg medium-3 columns">
					<img src="{{ asset( Plants::getAddress($list->plant_name, 'main') ) }}" alt="{{ $list->plant_name}}" />
		  		</div>
				<div class="plantListing medium-8 columns end">
					<div class="row">
						<h1>{{ $list->plant_name }}</h1>
					</div>
					<div class="row plantDetails">
						<p class="medium-4 columns">{{ $list->plant_type }}</p>
						<p class="medium-8 columns difficulty">Difficulty: <img src="{{ asset($list_diff) }}"</p>
					</div>
					<div class="row plantChart">
						<div class="medium-5 columns">
							<p><span>Sun:</span>{{ $list->sun_need}}</p>
							<p><span>Season:</span>{{ $list->season_name}}</p>
							<p><span>Soil:</span>{{ $list->soil_need}}</p>
						</div>
						<div class="medium-7 columns bottom rightCol">
							<p><span>Water:</span>{{ $list->water_need}}</p>
							<p><span>Harvest Time:</span>{{ $list->harvest_time }}</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		@endforeach
	</div> <!-- End Panel Content -->
	@include('includes/addRemovePanels')
@stop
