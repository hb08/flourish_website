@extends('layouts.master')
@section('content')
<div class="row">
  <h1 class="pageTitle">Garden Plotter</h1>
</div>
<div class="row panel_plot">
  <div class="row inlay">
      <div class="row">
        <h2>New Garden</h2>
      </div>
      <div class="row">
        <div class="row">
          <p>Select a plant from the drop down box, then click on a shape.</p>
        </div>
        <div class="row">
          <div class="medium-3 columns"> <!-- Plant/Shape Selection -->
            <select>

              <option></option>

            </select>
            <p>Shapes</p>
            <a href="#" class="linkButton">Save Garden</a>
          </div>
          <div class="medium-8 end columns"> <!-- Canvas -->
            <div id="canvas_frame">
              <script>
              function setup() {
                // Grid Setup
                var lineColor = 'rgba(9, 59, 13, 0.33)';
                var gx = getElement('width'); // Width of Garden from user
                gx = gx.html();
                var gy = getElement('height'); // Height of Garden from user
                gy = gy.html();

                // Canvas Size
                var gw = 700; // Chart Width ideal
                var gh = 500; // Chart Height ideal

                var xlength = floor(gw/gx); // Width of Grid Square
                var ylength = floor(gh/gy); // Height of Grid Square

                // Create the canvas
                var cnv = createCanvas(gx * xlength, gy * ylength);
                var div = document.getElementById('canvas_frame');
                cnv.parent(div).id('gardenCanvas');
                background('white');

                console.log("Xlength: " + xlength + "| Ylength: " + ylength);
                  // Horizontal Lines
                 for(i = 1; i < gx+1 ; i++ ){ // i is equal to 1, run loop until i = gx
                   stroke(lineColor);
                   line( 0, i * ylength, gw, i * ylength );
                 }
                 // Vertical Lines
                 for(i = 1; i <= gy; i++ ){ // i is equal to 1, run loop until i = gx
                   stroke(lineColor);
                   line( i * xlength, 0, i * xlength, gh);
                 }


              }
              function draw() {

              }
              </script>
            </div>
            <div class="medium-3 columns medium-offset-9">
              <p><span id="width">{{$input["width"]}}</span> x <span id="height">{{$input["height"]}}</span></p>
            </div>
          </div>
        </div>
      </div>
        <pre>
          {{ print_r($input) }}
        </pre>

      </div>
  </div> <!-- End Inlay -->
</div> <!-- End Panel Plot -->
</div> <!-- End Row -->
@stop
