@extends('layouts.master')
@section('content')
	<div class="row cal">
		<div class="medium-3 columns dateList">
			<ul class="accordion" data-accordion>
				<li class="heading accordion-navigation">
					<a href="#all">All Milestones</a>
					<div id="all" class="content">
						@if($milestones['plant'])
						<p>Waiting To Plant</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['plant']) ; $i++)
								<li class="plant"><a href="details/{{$milestones['plant'][$i]['pid']}}" class="{{$milestones['plant'][$i]['pid']}}"><span class="mPname">{{$milestones['plant'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['plant'][$i]['raw_date']}}">{{$milestones['plant'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['sprout'])
						<p>Sprout</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['sprout']) ; $i++)
								<li class="sprout"><a href="details/{{$milestones['sprout'][$i]['pid']}}" class="{{$milestones['sprout'][$i]['pid']}}"><span class="mPname">{{$milestones['sprout'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['sprout'][$i]['raw_date']}}">{{$milestones['sprout'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['thin'])
						<p>Thin</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['thin']) ; $i++)
								<li class="thin"><a href="details/{{$milestones['thin'][$i]['pid']}}" class="{{$milestones['thin'][$i]['pid']}}"><span class="mPname">{{$milestones['thin'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['thin'][$i]['raw_date']}}">{{$milestones['thin'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['fert'])
						<p>Fertilize</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['fert']) ; $i++)
								<li class="fert"><a href="details/{{$milestones['fert'][$i]['pid']}}" class="{{$milestones['fert'][$i]['pid']}}"><span class="mPname">{{$milestones['fert'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['fert'][$i]['raw_date']}}">{{$milestones['fert'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['harv'])
						<p>Harvest</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['harv']) ; $i++)
								<li class="harv"><a href="details/{{$milestones['harv'][$i]['pid']}}" class="{{$milestones['harv'][$i]['pid']}}"><span class="mPname">{{$milestones['harv'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['harv'][$i]['raw_date']}}">{{$milestones['harv'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
					</div>
				</li>
				<li class="planting accordion-navigation">
					<a href="#planting">Planting</a>
					<div id="planting" class="content">
						@if($milestones['plant'])
						<p>Waiting To Plant</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['plant']) ; $i++)
							<li class="plant"><a href="details/{{$milestones['plant'][$i]['pid']}}" class="{{$milestones['plant'][$i]['pid']}}"><span class="mPname">{{$milestones['plant'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['plant'][$i]['raw_date']}}">{{$milestones['plant'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@else
						<p>No plants waiting.</p>
						@endif
					</div>
				</li>
				<li class="misc accordion-navigation">
					<a href="#misc">Misc</a>
					<div id="misc" class="content">
						@if($milestones['sprout'])
						<p>Sprout</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['sprout']) ; $i++)
							<li class="sprout"><a href="details/{{$milestones['sprout'][$i]['pid']}}" class="{{$milestones['sprout'][$i]['pid']}}"><span class="mPname">{{$milestones['sprout'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['sprout'][$i]['raw_date']}}">{{$milestones['sprout'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['thin'])
						<p>Thin</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['thin']) ; $i++)
							<li class="thin"><a href="details/{{$milestones['thin'][$i]['pid']}}" class="{{$milestones['thin'][$i]['pid']}}"><span class="mPname">{{$milestones['thin'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['thin'][$i]['raw_date']}}">{{$milestones['thin'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
						@if($milestones['fert'])
						<p>Fertilize</p>
						<ul class="mList">
							@for($i = 0; $i < count($milestones['fert']) ; $i++)
							<li class="fert"><a href="details/{{$milestones['fert'][$i]['pid']}}" class="{{$milestones['fert'][$i]['pid']}}"><span class="mPname">{{$milestones['fert'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['fert'][$i]['raw_date']}}">{{$milestones['fert'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@endif
					</div>
				</li>
				<li class="harvest accordion-navigation">
					<a href="#harvest">Harvest</a>
					<div id="harvest" class="content">
						@if($milestones['harv'])
						<ul class="mList">
							@for($i = 0; $i < count($milestones['harv']) ; $i++)
							<li class="harv"><a href="details/{{$milestones['harv'][$i]['pid']}}" class="{{$milestones['harv'][$i]['pid']}}"><span class="mPname">{{$milestones['harv'][$i]['pname']}}</span> : <span class="due" name="{{$milestones['harv'][$i]['raw_date']}}">{{$milestones['harv'][$i]['end_date']}}</span></a>	</li>
							@endfor
						</ul>
						@else
						<p>No plants waiting.</p>
						@endif
					</div>
				</li>
			</ul>
			<a href="#" data-reveal-id="calAdd" class="linkButton">Add Milestone!</a>
		</div>
			<div class="medium-7 medium-offset-1 end columns calendar">
				<div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
						<div class="custom-header clearfix">
							<nav>
								<span id="custom-prev" class="custom-prev"></span>
								<span id="custom-next" class="custom-next"></span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
						</div>
						<div id="calendar" class="fc-calendar-container"></div>
					</div>
				</div>
			<div>
	</div><!-- End Calendar Row -->
	@include('includes.addRemoveMilestone')
</div>
@stop
