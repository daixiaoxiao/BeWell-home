/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function drawAllCharts(renderId1, renderId2, renderId3, renderId4, renderId5, data1, data2, data3, data4, data5,dateArray){
        drawBloodpressure(renderId1, data1);
        /*drawWeight(renderId2, data2);
        drawPain(renderId3, data3);
        drawActivity(renderId4, data4, dateArray);
        drawOxygen(renderId5, data5);*/
}


function drawBloodpressure(renderId1, data1, height, width) {


var materialOptions1 = {
          curveType: 'function',
          legend: { position: 'bottom' },
          width: width,
          height: height,
          fontName: 'Lato, sans-serif',
            animation:{
    duration: 1000,
    easing: 'out'
  }
        };
        
    var chart1 = new google.charts.Line(document.getElementById(renderId1));
    chart1.draw(data1, google.charts.Line.convertOptions(materialOptions1));
   
    
}

function drawWeight(renderId2, data2, height, width) {


var materialOptions2 = {
          curveType: 'function',
          legend: { position: 'bottom' },
          width: width,
          height: height,
          fontName: 'Lato, sans-serif'
        };

    var chart2 = new google.charts.Line(document.getElementById(renderId2));
    chart2.draw(data2, google.charts.Line.convertOptions(materialOptions2));
}


function drawPain(renderId3, data3, height, width) {

    var materialOptions3 = {
          curveType: 'function',
          legend: { position: 'bottom' },
          width: width,
          height: height,
          fontName: 'Lato, sans-serif'
        };

    var chart3 =  new google.charts.Line(document.getElementById(renderId3));
    

       chart3.draw(data3, google.charts.Line.convertOptions(materialOptions3));
}

function drawActivity(renderId4, data4, dateArray, height, width) {
    data4.insertColumn(0, 'date', data4.getColumnLabel(0));
    
    for (i = 0; i < dateArray.length; i++) {
        
        var toSplit = dateArray[i];
        var from = toSplit.split("/");
        var date4 = new Date((20+from[2]), from[1] - 1, from[0]);
        data4.setValue(i, 0, date4);
    }
    
    data4.removeColumn(1);

    var materialOptions4 = {
          width: width,
          height: height,
          fontName: 'Lato, sans-serif'
    };

    var chart4 =  new google.charts.Bar(document.getElementById(renderId4));

        chart4.draw(data4, google.charts.Bar.convertOptions(materialOptions4));
}

function drawOxygen(renderId5, data5, height, width) {

var materialOptions5 = {
          legend: { position: 'bottom' },
          width: width,
          height: height,
          fontName: 'Lato, sans-serif'
        };

        var chart5 =  new google.charts.Line(document.getElementById(renderId5));
        chart5.draw(data5, google.charts.Line.convertOptions(materialOptions5));


}

