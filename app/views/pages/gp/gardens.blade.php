@extends('layouts.master_panel')
@section('content')
	<div class="row panel-nav">
		<ul class="medium-6 columns medium-centered">
			<li class="medium-3 columns"><a href="growing">Growing</a></li>
			<li class="medium-3 columns listed"><a href="list">Listed</a></li>
			<li class="medium-3 columns gardens  selected"><a href="gardens">Gardens</a></li>
			<li class="medium-3 columns waiting"><a href="waiting">Waiting</a></li>
		</ul>
	</div>
	<div class="row panel-content">
		<h1>My Garden Plots</h1>
		<div class="row medium-collapse">
			<div class="medium-3 columns side-bar">
				<ul class="medium-12 columns">
						<li class="selected">
							<a href="#">
								<img src="{{asset('_images/garden_images/garden.png')}}" alt="" />
								My First Garden
							</a>
							<a href="#" class="delete">X</a>
						</li>
						<li>
							<a href="#">
								<img src="{{asset('_images/garden_images/garden.png')}}" alt="" />
								Veggie Garden
							</a>
							<a href="#" class="delete">X</a>
						</li>
				</ul>
				<a href="../plot_begin.php" class="linkButton">Add Garden</a>
			</div>
			<div class="medium-9 columns end panel-page">
					<div class="row">
						<h2>My First Garden</h2>
					</div>
					<div class="row">
						<div class="medium-8 columns">
							<div class="row links">
								<a href="#" class="medium-4 columns">Delete Garden Plot</a>
								<a href="#" class="medium-4 columns medium-offset-4 ">Edit Garden Plot</a>
							</div>
							<img src="{{asset('_images/garden_images/garden.png')}}" alt="" />
						</div>
						<div class="medium-4 columns">
							<table id="garden_plants">
								<tr>
									<th>Plants</th>
									<th>Yield</th>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
								<tr>
									<td>Plant Name</td>
									<td>1.2lbs</td>
								</tr>
							</table>
						</div>
					</div>
			</div><!-- End Panel Page -->
		</div>
	</div> <!-- End Panel Content -->
@stop
