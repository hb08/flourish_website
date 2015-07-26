<script>
// Shape Variables
  var shapeText;
  var type;
  var plants; // Hold Plant Lists
  var shapes = []; // Hold all shapes
  var shapeNum = 0; // Start at 0 and assign ID numbers to each shape
  var currentShape; // Var to hold number of shape pressed
// Grid Variables
  var lineColor = 'rgba(9, 59, 13, 0.33)';
  // Canvas Size
  var gw = 700; // Chart Max Width ideal
  var gh = 500; // Chart Max Height ideal
  // Grid Setup
  var gx; // Garden Cells Wide from user input
  var gy; // Garden Cells High from user input
  // Calculation Variables
  var xlength;
  var ylength;
  var cellSize;

// Get text from select box on change
function selectFunc(val){
  shapeText = val;
};
// Function called on shape click on Sidebar
function shapeFunc(shape){
  type = shape;
  var error = document.getElementById('noPlant');
  // Only make shapes if there is text
  if(shapeText){
    if(shape == 'square'){
      shapes.push( new Square() );
    }
    if(shape == 'rectangle'){
      shapes.push( new Rectangle() );
    }
    if(shape == 'circle'){
      shapes.push( new Circle() );
    }
    // Add to Plant List
    if(shapeText == undefined){
      var el = document.getElementById('selectPlant');
      shapeText =  el.options[el.selectedIndex].value;
    }
    plants = shapeText + ', ';
    shapeNum++;
    redraw();
    // Hide any errors that may have been shown
    $(error).addClass('hidden');
  }else{
  // Otherwise tell them what to do
    $(error).removeClass('hidden');
  }
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
  this.id = shapeNum;
  this.idMe = function(){
    return this.id;
  }
};
// Mouse Click Functions
function mousePressed(){
  //If click within the canvas
  if( (mouseX > 0 && mouseX < cellSize * gx)  && (mouseY > 0 && mouseY < cellSize * gy)){
    // Check shapes to see if this is in one
    for(var i = 0; i < shapes.length; i++){
        if( shapes[i].checkClick() ){
          shapes[i].pressed();
        }
    }
  }
}
function mouseUp(){
  for( var i = 0; i < shapes.length; i++ ){
    if(currentShape == shapes[i].idMe() ){
      shapes[i].released();
    }
  }
}
// Shape Prototype Methods
Shape.prototype.pressed = function(){
  currentShape = this.id;
};
Shape.prototype.released = function(){
  var changeX = mouseX;
  var changeY = mouseY;
  // Snap to grid
    // If mouse position is not divisble by cellSize evenly,
    if(changeX % cellSize != 0 ){
      var test = Math.floor(changeX/cellSize); // Round that down
      var testRes = cellSize * test; // Multiply by cellSize
      changeX = testRes;
    }
    // If mouse position is not divisble by cellSize evenly,
    if(changeY % cellSize != 0){
      var test = Math.floor(changeY/cellSize); // Round that down
      var testRes = cellSize * test; // Multiply by cellSize
      changeY = testRes;
    }

  // Coordinates of Shape are the results
  this.x = changeX;
  this.y = changeY;
  // Redraw everything
  redraw();
};
Shape.prototype.checkClick = function(){
  if( ((mouseX > this.x) && (mouseX < (this.x + this.w))) && ((mouseY > this.y) && (mouseY < (this.y + this.h))) ){
    return true;
  }
}
Shape.prototype.showText = function(){
  // Text Size
  var fontSize = 10;
  // Text Placement
  var textX = this.x + 2;
  var textY = this.y + fontSize;
  // Text Display
  textFont("Comfortaa");
  textSize(fontSize);
  textLeading(fontSize);
  stroke('#000');
  text(this.shapeText, textX, textY, this.w, this.h);
  // Add to Hidden Input
  shapeHold = getElement('holdShapes');
  holdText = JSON.stringify(shapes);
  shapeHold.html(holdText);
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

function addOldShapes(oldShapes){
  // Get code
  var old = oldShapes;
  for(var key in old){
    var thisText = old[key]['shapeText'];
    var shape = old[key]['type'];
    var oldX = old[key]['x'];
    var oldY = old[key]['y'];
    var oldH = old[key]['h'];
    var oldW = old[key]['w'];

    if(shape == 'square'){
      var newShape = new Square();
    }
    if(shape == 'rectangle'){
      var newShape = new Rectangle();
    }
    if(shape == 'circle'){
      var newShape = new Circle();
    }
    newShape.shapeText = thisText;
    newShape.type = shape;
    newShape.x = oldX;
    newShape.y = oldY;
    newShape.h = oldH;
    newShape.w = oldW;
    shapes.push(newShape);
    shapeNum ++;
  }
}
function setup() {
  // Set Grid Variables
  gx = getElement('width'); // Width of Garden from user
  gx = gx.html();
  gy = getElement('height'); // Height of Garden from user
  gy = gy.html();
  xlength = floor(gw/gx); // Width of Grid Square
  ylength = floor(gh/gy); // Height of Grid Square
  if(document.getElementById('oldCode')){
    oldCode = document.getElementById('oldCode').innerHTML;
    code = JSON.parse(oldCode);
    addOldShapes(code);
  }
  // Adjust cellSize to user Input
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
// Add Grid Background
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
// Add Shapes
  for( i = 0; i < shapes.length; i++ ){
    shape = shapes[i];
    stroke('#7a7a7a');
    fill('white');
    shape.display();
    shape.showText();
  }
}

</script>
