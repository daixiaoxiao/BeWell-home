<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">
        
        <!-- top message -->
        <div class="row">
            <div class="topMessage col-sm-12 hidden-xs">
                Your sleep measurements
            </div>
        </div>
        <!-- top message -->
        
        <!-- graph -->
        <div class="row">
            <div id="graphHistory" class="responsive-container">
                <div id= "graphA" class="item active"></div>
                <div class="btn btn-primary backtombutton" onclick="location.href = 'dataPatient'">Back to measurements</div>
            </div>
        </div>
        <!-- /graph -->
        
        <script type="text/javascript">
            /*
             * Script for the graph
             */
            google.setOnLoadCallback(drawChart);
            function drawChart() {


                var dateActivity = new Array();
<?php foreach ($activity_data as $data) { ?>
                    dateActivity.push('<?php echo $data->date; ?>');
<?php } ?>

                var dataActivity = google.visualization.arrayToDataTable([
                    ['Date', 'Steps', 'calories', 'distance'],
<?php
foreach ($activity_data as $data) {
    echo '[' . $data->date . ',' . $data->steps . ',' . $data->calories . ',' . $data->distance . '],';
}
?>
                ]);


                dataActivity.insertColumn(0, 'date', dataActivity.getColumnLabel(0));

                for (i = 0; i < dateActivity.length; i++) {

                    var toSplit = dateActivity[i];
                    var from = toSplit.split("/");
                    var date4 = new Date((20 + from[2]), from[1] - 1, from[0]);
                    dataActivity.setValue(i, 0, date4);
                }

                dataActivity.removeColumn(1);



                var options = {
                    title: 'History Activity/Sleep Measurements',
                    'width': 1300,
                    'height': 600,
                fontName: 'Lato, sans-serif',};

                var chart = new google.charts.Bar(document.getElementById('graphA'));
                chart.draw(dataActivity, google.charts.Bar.convertOptions(options));
            }
        </script>

        <!-- /container -->
    </div>

</body>
</html>