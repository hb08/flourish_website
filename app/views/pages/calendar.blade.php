@extends('layouts.master')
@section('content')
	<div class="row cal">
		<div class="medium-2 medium-offset-1 columns dateList">
			<ul>
				<li class="heading">June 2015</li>
				<li class="planting"><a href="#" data-reveal-id="calDetails">Planting</a></li>
				<li class="prep"><a href="#">Milestone</a></li>
				<li class="harvest"><a href="#">Harvest</a></li>
			</ul>
			<a href="#" class="linkButton">Add Milestone!</a>
		</div>
			<table class="medium-7 medium-offset-1 end columns calendar">
				<thead>
					<tr>
						<th><a class="arrow" href="#" id="prevMonth"></a></th>
						<th colspan="5">June 2015</th>
						<th><a class="arrow" href="#" id="nextMonth"></a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Su</td>
						<td>Mo</td>
						<td>Tu</td>
						<td>We</td>
						<td>Th</td>
						<td>Fr</td>
						<td>Sa</td>
					</tr>
					<tr>
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td class="today">4</td>
						<td>5</td>
						<td>6</td>
					</tr>
					<tr>
						<td>7</td>
						<td>8</td>
						<td>9</td>
						<td>10</td>
						<td>11</td>
						<td>12</td>
						<td>13</td>
					</tr>
					<tr>
						<td>14</td>
						<td>15</td>
						<td>16</td>
						<td>17</td>
						<td>18</td>
						<td>19</td>
						<td>20</td>
					</tr>
					<tr>
						<td>21</td>
						<td>22</td>
						<td>23</td>
						<td>24</td>
						<td>25</td>
						<td>26</td>
						<td>27</td>
					</tr>
					<tr>
						<td>28</td>
						<td>29</td>
						<td>30</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<div id="calDetails" class="reveal-modal" data-reveal  aria-hidden="true" role="dialog">
				<div class="detailsPanel">
					<h1>June 9th</h1>
					<p class="milestone">Your <a href="details/">Strawberry</a> sprouts soon!</p>
					<img src="{{asset('_images/plant_images/strawberry_sprout.jpg')}}" alt="Strawberry Sprout| Flourish – Your Florida Gardening Guide" />
					<p class="details">
						{{ DB::table('plant_info')->where('plant_id', 4)->pluck('plant_prep')}}
					</p>
				</div>
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
				<div class="reveal-modal-bg" style="display: none"></div>
			</div>
	</div><!-- End Calendar Row -->
@stop
