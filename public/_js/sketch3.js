<script>
var shapeText;
var type;
var cellSize;
var xlength;
var ylength;
var shapes = []; // Hold all shapes
var shapeNum = 0; // Start at 0 and assign ID numbers to each shape
var currentShape; // Var to hold number of shape pressed

// Get text from select box on change
function selectFunc(val){
  shapeText = val;
};
// Function called on shape click on Sidebar
function shapeFunc(shape){
  type = shape;
  if(shape == 'square'){
    shapes.push( new Square() );
  }
  if(shape == 'rectangle'){
    shapes.push( new Rectangle() );
  }
  if(shape == 'circle'){
    shapes.push( new Circle() );
  }
  redraw();
}
// Create Shape Superclass
var Shape = function(){
  this.type = type;
  // Shape size
  this.h = cellSize;
  this.w = cellSize;
  // Shape Placement
  this.x = 0;
  this.y = 0;
  // Shape Text
  this.shapeText = shapeText;
  // Shape ID
  this.id = i;
  this.idMe = function(){
    return this.id;
  }
};
// Mouse Click Functions
function mousePressed(){
  var gx = getElement('width'); // Width of Garden from user
  gx = gx.html();
  var gy = getElement('height'); // Height of Garden from user
  gy = gy.html();
  //If click within the canvas
  if( (mouseX > 0 && mouseX < cellSize * gx)  && (mouseY > 0 && mouseY < cellSize * gy)){
    console.log("CANVAS!");
    // Check shapes to see if this is in one
    for(var i = 0; i < shapes.length; i++){
        if( shapes[i].checkClick() ){
          shapes[i].pressed();
        }
    }
  }
}
function mouseUp(){
  var changeX = mouseX;
  var changeY = mouseY;
  for( var i = 0; i < shapes.length; i++ ){
    if(currentShape == shapes[i].idMe() ){
      shapes[i].released(changeX, changeY);
    }
  }
}

// Shape Prototype Methods
Shape.prototype.pressed = function(){
  currentShape = this.id;
};
Shape.prototype.released = function(changeX, changeY){
  // Snap to grid
  if(this.type == "circle"){
    this.x = changeX;
    this.y = changeY;
  }else{
    this.x = changeX;
    this.y = changeY;
  }
  redraw();
};
Shape.prototype.checkClick = function(){
  if( ((mouseX > this.x) && (mouseX < (this.x + this.w))) && ((mouseY > this.y) && (mouseY < (this.y + this.h))) ){
    return true;
  }
}
Shape.prototype.showText = function(){
  var fontSize = 10;
  var textX = this.x + 2;
  var textY = this.y + fontSize;
  textFont("Comfortaa");
  textSize(fontSize);
  textLeading(fontSize);
  stroke('#000');
  text(this.shapeText, textX, textY, this.w, this.h);
}
// Create shape subclasses calling on Shape Superclass
var Square = function(){
  Shape.call(this);
};
var Rectangle = function(){
  Shape.call(this);
};
var Circle = function(){
  Shape.call(this);
};

// Each subclass uses Shape Superclass prototype
Square.prototype = Object.create(Shape.prototype);
Rectangle.prototype = Object.create(Shape.prototype);
Circle.prototype = Object.create(Shape.prototype);
// Set Each shape Display
Square.prototype.display = function(){
  rect(this.x, this.y, this.w, this.h);
};
Rectangle.prototype.display = function(){
  if(ylength/cellSize < 2){
    this.w = cellSize * 2;
    this.h = cellSize;
    rect(this.x , this.y, this.w, this.h);
  }else{
    this.w = cellSize;
    this.h = cellSize * 2;
    rect(this.x, this.y, this.w, this.h);
  }
};
Circle.prototype.display = function() {
  this.h = cellSize;
  this.w = cellSize;
  ellipse(this.x + (cellSize/2), this.y + (cellSize/2), this.w, this.h);
};




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
  cnv.mouseReleased(mouseUp);
  noLoop();
}
function draw(){
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

  for( i = 0; i < shapes.length; i++ ){
    shape = shapes[i];
    stroke('#7a7a7a');
    fill('white');
    shape.display();
    shape.showText();
  }
}

</script>
