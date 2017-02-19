<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">

        <!-- top message -->
        <div class="row">
            <div class="topMessage col-sm-12 hidden-xs">
                Your blood pressure measurements
            </div>
        </div>
        <!-- /top mesage -->

        <!-- graph -->
        <div class="row">
            <div id="graphHistory" class="responsive-container">
                <div id= "graphBP" class="item active"></div>
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
                var dataPressure = google.visualization.arrayToDataTable([
                    ['Time', 'Systolic Pressure', 'Diastolic Pressure'],
<?php
foreach ($pressure_data as $data) {
    echo '[' . $data->date . ',' . $data->pressureSystolic . ',' . $data->pressureDiastolic . '],';
}
?>
                ]);
                var options = {
                    title: 'History Weight Measurements',
                    'width': 1300,
                    'height': 600,
                    fontName: 'Lato, sans-serif',
                    animation: {
                        duration: 2000,
                        easing: 'out',
                        startup: true
                    }};
                var chart = new google.charts.Line(document.getElementById('graphBP'));
                chart.draw(dataPressure, options);
            }
        </script>

        <!-- /container -->
    </div>

</body>
</html>