@extends('layouts.master')
@section('content')
	<div class="row">
		<h1>Garden Overview</h1>	
	</div>	
	<div class="row iconLinks">
		<div class="medium-2 medium-offset-2 columns">
			<a href="gp/growing"><span></span>Plants Growing</a>
		</div>
		<div class="medium-2 columns">
			<a id="lists" href="gp/list">Plants List</a>
		</div>
		<div class="medium-2 columns">
			<a id="gardens" href="gp/gardens">Gardens Plotted</a>
		</div>
		<div class="medium-2 end columns">
			<a id="waiting" href="gp/waiting">Waiting to Grow</a>
		</div>	
	</div>
	<div class="row gages">
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<p>Gages Go Here With User Specific Interactivity Update</p>
	</div>
@stop


