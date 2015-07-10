@extends('layouts.master_sub')
@section('content')
<div class="row">
  <h1 class="pageTitle">Garden Plotter</h1>
</div>
<div class="row">
    <div class="row">
      <div class="medium-3 columns choice"> <!-- Plant/Shape Selection -->
        <p>Select a plant from the drop down box, then click on a shape.</p>
        <select class="medium-12 columns" onchange="selectFunc(this.value)">
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
        <a href="#" class="linkButton save_garden" data-reveal-id="saveDialog">Save Garden</a>
      </div>
      <div class="medium-8 end columns"> <!-- Canvas -->
        <div id="canvas_frame">
          @include('includes.scripts')
        </div>
        <p class="row"><span id="width">{{$input["width"]}}</span> x <span id="height">{{$input["height"]}}</span></p>
      </div>
    </div>
</div> <!-- End Row -->
@include('includes.saveGarden');
@stop
