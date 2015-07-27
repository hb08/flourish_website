@extends('layouts.master_sub')
@section('content')
<div class="row">
  <h1 class="pageTitle">Garden Plotter</h1>
  <p class="hidden error" id="noPlant">Select a plant <i>before</i> selecting a shape!</p>
</div>
<div class="row">
    <div class="row">
      <div class="medium-3 columns choice"> <!-- Plant/Shape Selection -->
        <p>Select a plant from the drop down box, then click on a shape.</p>
        <select class="medium-12 columns" onchange="selectFunc(this.value)" id="selectPlant">
          <option value="">Select a Plant</option>
          @foreach($plants as $p)
            <option value='{{$p}}'>{{$p}}</option>
          @endforeach
        </select>
        <div id="shapes">
          <div id="square" onclick="shapeFunc('square')">
          </div>
          <div id="rectangle" onclick="shapeFunc('rectangle')">
          </div>
          <div id="circle" onclick="shapeFunc('circle')">
          </div>
        </div>
        <p>To delete a shape, click and hold the shape and press the SHIFT button.</p>
        <a href="#" class="linkButton save_garden" data-reveal-id="saveDialog">Save Garden</a>
      </div>
      <div class="medium-8 end columns"> <!-- Canvas -->
        <div id="canvas_frame">
          @include('includes.scripts')
        </div>
        <div class="sizeDisplay">
          <p><span id="width">{{$input["width"]}}</span> x <span id="height">{{$input["height"]}}</span></p>
          <p>1 square = 1ft<sup>2</sup></p>
        </div>
      </div>
    </div>
</div> <!-- End Row -->
@include('includes.saveGarden')
@stop
