/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function drawChart(dataTable) {


        var options = {
          title: 'My Daily Activities'
        };

     
      var chart = new google.charts.Bar(document.getElementById('carousel1'));
      chart.draw(dataTable, options);
      return dataTable;
 }
 
 function drawBlood(idArray, nrElements) {
     
     
     
     var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

     
      var chart = new google.visualization.PieChart(document.getElementById('carouselBlood'));
      chart.draw(data, options);
      return data;
 }
 
 /**
 * Convert an instance of google.visualization.DataTable to CSV
 * @param {google.visualization.DataTable} dataTable_arg DataTable to convert
 * @return {String} Converted CSV String
 */
function dataTableToCSV(dataTable_arg) {
    var dt_cols = dataTable_arg.getNumberOfColumns();
    var dt_rows = dataTable_arg.getNumberOfRows();
    
    var csv_cols = [];
    var csv_out;
    
    // Iterate columns
    for (var i=0; i<dt_cols; i++) {
        // Replace any commas in column labels
        csv_cols.push(dataTable_arg.getColumnLabel(i).replace(/,/g,""));
    }
    
    // Create column row of CSV
    csv_out = csv_cols.join(",")+"\r\n";
    
    // Iterate rows
    for (i=0; i<dt_rows; i++) {
        var raw_col = [];
        for (var j=0; j<dt_cols; j++) {
            // Replace any commas in row values
            raw_col.push(dataTable_arg.getFormattedValue(i, j, 'label').replace(/,/g,""));
        }
        // Add row to CSV text
        csv_out += raw_col.join(",")+"\r\n";
    }
    return csv_out;
 
}

function downloadCSV (csv_out) {
            var blob = new Blob([csv_out], {type: 'text/csv;charset=utf-8'});
            var url  = window.URL || window.webkitURL;
            var link = document.createElementNS("http://www.w3.org/1999/xhtml", "a");
            link.href = url.createObjectURL(blob);
            link.download = "selectedData.csv"; 

            var event = document.createEvent("MouseEvents");
            event.initEvent("click", true, false);
            link.dispatchEvent(event); 
}