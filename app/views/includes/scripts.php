<script>
var text;
var cellSize;
function selectFunc(val){
  text = val;
  console.log(text);
}
function setup() {
  // Grid Setup
  var lineColor = 'rgba(9, 59, 13, 0.33)';
  var gx = getElement('width'); // Width of Garden from user
  gx = gx.html();
  var gy = getElement('height'); // Height of Garden from user
  gy = gy.html();

  // Canvas Size
  var gw = 700; // Chart Max Width ideal
  var gh = 500; // Chart Max Height ideal

  var xlength = floor(gw/gx); // Width of Grid Square
  var ylength = floor(gh/gy); // Height of Grid Square

  if(xlength <= ylength){
    cellSize = xlength;
  }else {
    cellSize = ylength;
  }

  // Create the canvas
  var cnv = createCanvas(gx * cellSize, gy * cellSize);
  var div = document.getElementById('canvas_frame');
  cnv.parent(div).id('gardenCanvas');
  background('white');

    // Horizontal Lines
   for(i = 1; i < gx+1 ; i++ ){ // i is equal to 1, run loop until i = gx
     stroke(lineColor);
     line( 0, i * cellSize, gw, i * cellSize );
   }
   // Vertical Lines
   for(i = 1; i < gy+1 ; i++ ){ // i is equal to 1, run loop until i = gx
     stroke(lineColor);
     line( i * cellSize, 0, i * cellSize, gh);
   }

   noLoop();
}
function draw(){

}


</script>
