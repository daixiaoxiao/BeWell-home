<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">
        
        <!-- top message -->
        <div class="row">
            <div class="topMessage col-sm-12 hidden-xs">
                Your oxygen measurements
            </div>
        </div>
        <!-- /top message -->
        
        <!-- graph -->
        <div class="row">
            <div id="graphHistory" class="responsive-container">
                <div id= "graphO" class="item active"></div>
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
                var dataOxygen = google.visualization.arrayToDataTable([
                    ['Time', 'Oxygen'],
<?php
foreach ($oxygen_data as $data) {
    echo '[' . $data->date . ',' . $data->oxygenSaturation . '],';
}
?>
                ]);
                var options = {
                    title: 'History Oxygen Measurements',
                    'width': 1300,
                    'height': 600,
                    fontName: 'Lato, sans-serif',
                    animation: {
                        duration: 2000,
                        easing: 'out',
                        startup: true
                    }};
                var chart = new google.charts.Line(document.getElementById('graphO'));
                chart.draw(dataOxygen, options);
            }
        </script>

        <!-- /container -->
    </div>

</body>
</html>