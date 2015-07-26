@extends('layouts.master')
@section('content')
<div class="row" id="index">
	<div class="medium-6 columns slides" >
		<div>
			<img src="{{ asset('_images/image_slider/slider_1_strawberry.jpg') }}" alt="Strawberries | Flourish – Your Florida Gardening Guide" />
			<div class="cap">
				<p class="medium-9 columns">
					<b>Sweet Summer Strawberries</b>
					can be yours. Easy to care for, and even easier to propogate, start preparing your garden today to reap the rewards for years to come!
				</p>
				<a href="details/7" class="medium-3 columns linkButton">
					See More +
				</a>
			</div>
		</div>
		<div>
			<img src="{{ asset('_images/image_slider/slider_2_broccoli.jpg') }}" alt="Broccoli | Flourish – Your Florida Gardening Guide" />
			<div class="cap">
				<p class="medium-9 columns">
					<b>Nothing Beats Broccoli</b>
					when it comes to a great source of vitamins you can grow in your own backyard. Garden your way to better health today.
				</p>
				<a href="details/4" class="medium-3 columns linkButton">
					See More +
				</a>
			</div>
		</div>
		<div>
			<img src="{{ asset('_images/image_slider/slider_3_peppers.jpg') }}" alt="Bell Peppers | Flourish – Your Florida Gardening Guide" />
			<div class="cap">
				<p class="medium-9 columns">
					<b>Here a Pepper</b>
					there a pepper, everywhere in Florida grow a pepper. Add a variety of color and flavors to your garden with Bell Peppers.
				</p>
				<a href="details/8" class="medium-3 columns linkButton">
					See More +
				</a>
			</div>
		</div>
	</div>
	<div class="welcome medium-5 columns medium-offset-1 ">
		<h1>Welcome to Flourish!</h1>
		<p>
			The Sunshine State is the perfect place to grow your very own fruits and vegetables. Finding information on gardening in a state with mild winters can be incredibly difficult, but Flourish is here, to provide you all you need to know to get started on your very own edible garden.
		</p>
		<ul>
			<li><a href="search">Search</a> for plants in your zip code.</li>
			<li>Plan your own garden with our <a href="plot">Garden Plotter</a>.</li>
			<li>Add events and milestones to your <a href="calendar">Calendar</a>.</li>
			<li>Check your garden status in the <a href="overview">Garden Overview</a>.</li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="medium-3 columns">
		<div class="panel-grid">
			<a href="search">
				<h1><span class="icon search"></span>Plant Directory</h1>
				<p>Search for the plants you want to grow by zip code. Filter the results by type, difficulty, or needs. View plant details to find out if it works for you.</p>
			</a>
		</div>
	</div>
	<div class="medium-3 columns">
		<div class="panel-grid">
			<a href="plot">
				<h1><span class="icon plot"></span>Garden Plotter</h1>
				<p>Plan your garden using plants that grow in your area, or plants you've saved to your plant list. Predict how much you'll get in an average crop yield, and save for later.</p>
			</a>
		</div>
	</div>
	<div class="medium-3 columns">
		<div class="panel-grid">
			<a href="calendar">
				<h1><span class="icon calendar"></span>My Calendar</h1>
				<p>Add plants to your calendar, or view the ones you have. Check milestones and events specific to the plants in your garden.</p>
			</a>
		</div>
	</div>
	<div class="medium-3 columns">
		<div class="panel-grid">
			<a href="overview">
				<h1><span class="icon overview"></span>Garden Overview</h1>
				<p>Once you've started your garden, and added your growing plants to your list, you can track exactly what you have, and what it needs </p>
			</a>
		</div>
	</div>
</div>
@stop
