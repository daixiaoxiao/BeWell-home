<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">
        
        <!-- top message -->
        <div class="row">
            <div class="topMessage col-sm-12 hidden-xs">
                Your weight measurements
            </div>
        </div>
        <!-- /top message -->
        
        <!-- graph -->
        <div class="row">
            <div id="graphHistory" class="responsive-container">
                <div id= "graphW" class="item active"></div>
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
                var dataWeight = google.visualization.arrayToDataTable([
                    ['Time', 'Weight'],
<?php
foreach ($weight_data as $data) {
    echo '[' . $data->date . ',' . $data->weight . '],';
}
?>
                ]);
                var options = {
                    title: 'History Weight Measurements',
                    'width': 1300,
                    'height': 600,
                    animation: {
                        duration: 2000,
                        easing: 'out',
                        fontName: 'Lato, sans-serif',
                        startup: true
                    }};
                var chart = new google.charts.Line(document.getElementById('graphW'));
                chart.draw(dataWeight, options);
            }
        </script>

        <!-- /container -->
    </div>

</body>
</html>