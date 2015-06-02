@extends('layouts.master')
@section('content')
{{ Form:: open(array('url'=>'newSearch')) }}
<div class="row">
	<div class="medium-4 columns medium-offset-4">
		{{ Form::text('search', 'Search by zip code or city') }}
	</div>
	<div class="medium-1 columns end">
		<input type="submit" class="searchButton" />
	</div>
</div>
<div class="row">
	<div class="medium-2 columns">
		<select name="difficulty">
			<option value="0">Difficulty</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>
	</div>
	<div class="medium-2 columns">
		<select name="season">
			<option value="0">Season</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>	
	</div>
	<div class="medium-2 columns">
		<select name="grow">
			<option value="0">Grow Time</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>		
	</div>
	<div class="medium-2 columns">
		<select name="sun">
			<option value="0">Sun</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>		
	</div>
	<div class="medium-2 columns">
		<select name="water">
			<option value="0">Water</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>	
	</div>
	<div class="medium-2 columns">
		<select name="soil">
			<option value="0">Soil</option>
			<option value="1">Beginner</option>
			<option value="2">Easy</option>
			<option value="3">Intermediate</option>
			<option value="4">Difficult</option>
			<option value="5">Expert</option>
		</select>	
	</div>	
	{{ Form::close() }}
</div>
<div class="row">
	
</div>




@stop