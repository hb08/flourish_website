<script type="text/javascript">
  var splitText = function(type){
    var final = [];
    var thisType = type;
    var textChange = document.getElementById(thisType).innerHTML;
    var splitText = textChange.split("|");
    splitText.forEach(function(e){
      // For every split item
      var finalSplit = e.split(",");
      // Check if it's null (end) if not, split and add
      if(finalSplit[0] != ""){
        final.push({
          "type": finalSplit[0],
          "need": finalSplit[1]
        });
      }
    })
    return final;
  }
  var water = splitText('water');
  var soil = splitText('soil');
  var sun = splitText('sun')
  var diff = splitText('diff');

  drawThisChart( water, 'water');
  drawThisChart( soil, 'soil');
  drawThisChart( sun, 'sun');
  drawThisChart( diff, 'diff');
  function showLabels(){
    var labels = document.getElementsByClassName('dialLabel');
      for(var i = 0; i < labels.length; i++){
        labels[i].style.display = "block";
      }
  }

  function drawThisChart(chartType, chartName){
    var labelName = chartName + "chart";
    // Load the Visualization API library and the piechart library.
     google.load('visualization', '1.0', {'packages':['corechart']});
     google.setOnLoadCallback(drawChart);
     // Draw Chart
     function drawChart(){
       // Data Table
       var data = new google.visualization.DataTable();
       data.addColumn('string', labelName);
       data.addColumn('number', 'Times');
       for( i = 0; i < chartType.length; i++){
         console.log("On " + i);
         thisType = chartType[i]['type'];
         thisNeed = parseInt(chartType[i]['need']);
         data.addRow([thisType , thisNeed]);
       }
       // Set Chart Options
       if(chartName == 'water'){
         colors = ['#6CDFEB','#82CAF4','#60AEF6','#5FDAFA'];
       }else if(chartName == 'sun'){
         colors = ['#F9F8CD','#FFFA7A','#ECEA00','#FFDA57'];
       }else if(chartName == 'soil'){
         colors = ['#FFE0AC','#FFD67A','#ECA300','#CC7434'];
       }else if(chartName == 'diff'){
         colors = ['#E7F9CD','#BBF299','#15DE03','#009F10'];
       }
       var options = {
         chartArea: {left: 0, top: 5, width: '95%', height: '95%'},
         pieHole: 0.5,
         legend: 'none',
         colors: colors,
         pieSliceBorderColor: '#093B0D',
         pieSliceText: 'value',
         pieSliceTextStyle: {fontSize: 20, color: '#093B0D'}
       };
       var chart = new google.visualization.PieChart(document.getElementById(labelName));
       chart.draw(data, options);
       showLabels();
     } // End Draw Chart
} // End Draw This Chart
</script>
