<script>
var text;
var cellSize;
var xlength;
var ylength;
var shapes = [];
var i = 0
// Get text from select box on change
function selectFunc(val){
  text = val;
};
var Square = function(){
  this.x = 0;
  this.y = 0;
  this.h = cellSize;
  this.w = cellSize;
};
var  Rectangle = function(){
  this.x = 0;
  this.y = 0;
  this.h = cellSize;
  this.w = cellSize;
};
var Circle = function(){
  this.x = 0;
  this.y = 0;
  this.h = cellSize;
  this.w = cellSize;
}
Square.prototype.display = function(){
  rect(this.x, this.y, this.h, this.w);
};
Rectangle.prototype.display = function(){
  if(ylength/cellSize < 2){
    rect(0 , 0, cellSize * 2, cellSize);
  }else{
    rect(0,0, cellSize, cellSize * 2);
  }
};
Circle.prototype.display = function() {
      ellipse(cellSize/2 , cellSize/2, cellSize, cellSize);
};

// Function called on shape click
function shapeFunc(shape){
  if(shape == 'square'){
    shapes.push( new Square() );
  }
  if(shape == 'rectangle'){
    shapes.push( new Rectangle() );
  }
  if(shape == 'circle'){
    shapes.push( new Circle()) ;
  }
  redraw();
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

  xlength = floor(gw/gx); // Width of Grid Square
  ylength = floor(gh/gy); // Height of Grid Square

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
  console.log("Shapes")
  console.log(shapes);
  console.log("----------------------");
  for( i = 0; i < shapes.length; i++ ){
    stroke('black');
    console.log('Shape ' + [i]);
    console.log(shapes[i]);
    shapes[i].display();
  }
}

</script>
