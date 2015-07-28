@extends('layouts.master_panel')
@section('content')
	<div class="row panel-nav">
		<ul class="medium-6 small-12 columns medium-centered">
			<li class="medium-3 small-3 columns"><a href="growing"><span class="hideWords">Growing</span><span class="showNumbers">{{$totals['counts']['growing']}}</span></a></li>
			<li class="medium-3 small-3 columns listed"><a href="list"><span class="hideWords">Listed</span><span class="showNumbers">{{$totals['counts']['plants']}}</span></a></li>
			<li class="medium-3 small-3 columns gardens  selected"><a href="gardens"><span class="hideWords">Gardens</span><span class="showNumbers">{{$totals['counts']['plots']}}</span></a></li>
			<li class="medium-3 small-3 columns waiting"><a href="waiting"><span class="hideWords">Waiting</span><span class="showNumbers">{{$totals['counts']['waiting']}}</span></a></li>
		</ul>
	</div>
	<div class="row panel-content">
		<h1>My Garden Plots</h1>
		@if(isset($gardens))
		<div class="row medium-collapse">
			<div class="medium-3 columns side-bar">
				<ul class="medium-12 columns">
					@foreach($gardens as $garden)
						<!-- If $thisPlant exists, and is the same as this number -->
								@if(isset($thisPlant) && $thisPlant == $garden->id)
									<li class="selected">
								@else
									<li>
								@endif
								<a href="view/gardens/{{$garden->id}}">
									<img src="{{ $garden->img }}" alt="{{ $garden->name }}" />
									{{$garden->name}}
								</a>
								<a href="#" class="delete plantRemove" data-reveal-id="listRemove" id="{{$garden->id}}" name="{{$garden->name}}">X</a>
							</li>
					@endforeach
					</ul>
					<a href="../plot" class="linkButton">Add Garden</a>
			</div>
				<div class="medium-9 columns end panel-page">
					@foreach($gardens as $garden)
							@if(isset($thisPlant) && $thisPlant == $garden->id)
							<div class="row">
								<h2>{{$garden->name}}</h2>
							</div>
							<div class="row">
								<div class="medium-8 columns">
									<div class="row links">
										<a a href="#" class="delete plantRemove medium-4 columns" data-reveal-id="listRemove" id="{{$garden->id}}" name="{{$garden->name}}">Delete Garden Plot</a>
										<a href="../plot/edit/{{$garden->id}}" class="medium-4 columns medium-offset-4 ">Edit Garden Plot</a>
									</div>
									<img src="{{$garden->img}}" alt="$garden->name" />
								</div>
								<div class="medium-4 columns">
									<table id="garden_plants">
										<tr>
											<th>Plants</th>
											<th>Yield</th>
										</tr>
										@for($c = 0; $c < count($yieldList); $c++)
											@if($yieldList[$c]['yield'] != NULL)
												<tr>
													<td>{{$yieldList[$c]['name']}}</td>
													<td>{{$yieldList[$c]['total']}}<span>lbs</span></td>
												</tr>
											@endif
										@endfor
									</table>
								</div>
							</div>
							@endif
						@endforeach
			</div><!-- End Panel Page -->
		</div>
		@else
		<div class="row addRow">
			<a href="../plot" class="linkButton">Add Garden</a>
		</div>
		@endif
	</div> <!-- End Panel Content -->
@include('includes/addRemovePanels')
@stop
