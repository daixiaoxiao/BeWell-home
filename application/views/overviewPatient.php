<!DOCTYPE html>

<body>
    <!-- container -->
    <div id="container" class="container">
        <div class="row">
            <!-- welcome title -->
            <div class="topMessage">
                Overview of patient: {patient} {Firstname} {Lastname} {/patient}
            </div>
        </div>
        <script type="text/javascript">




            var dateActivity = Array();
            
<?php if($activity_data !== null) {foreach ($activity_data as $data) { ?>
                dateActivity.push('<?php echo $data->date; ?>');
<?php }} ?>


            var dataPressure = [
                ['Time', 'Systolic Pressure', 'Diastolic Pressure'],
<?php if($pressure_data !== null){
foreach ($pressure_data as $data) {
    echo '[' . $data->date . ',' . $data->pressureSystolic . ',' . $data->pressureDiastolic . '],';
}}
?>
            ];
            var dataWeight = [
                ['Time', 'Weight'],
<?php if($weight_data !== null){
foreach ($weight_data as $data) {
    echo '[' . $data->date . ',' . $data->weight . '],';
}}
?>
            ];
            var dataPain = [
                ['Time', 'Pain'],
<?php if($pain_data !== null){
foreach ($pain_data as $data) {
    echo '[' . $data->date . ',' . $data->painLevel . '],';
}}
?>
            ];
            var dataActivity = [
                ['Date', 'Steps', 'calories', 'distance'],
<?php if($activity_data !== null){
foreach ($activity_data as $data) {
    echo '[' . $data->date . ',' . $data->steps . ',' . $data->calories . ',' . $data->distance . '],';
}}
?>
            ];
            var dataOxygen = [
                ['Time', 'Oxygen'],
<?php if($oxygen_data !== null){
foreach ($oxygen_data as $data) {
    echo '[' . $data->date . ',' . $data->oxygenSaturation . '],';
}}
?>
            ];






            google.charts.setOnLoadCallback(drawChart);

            var width = 400; //removed to acheive 100% width
            var height = 400;

            function drawChart() {
                if(dataActivity.length !== 1)
                {
                var datatest = new google.visualization.arrayToDataTable(dataActivity);
                datatest.insertColumn(0, 'date', 'Time');

                for (i = 0; i < dateActivity.length; i++) {

                    var toSplit = dateActivity[i];
                    var from = toSplit.split("/");
                    var date4 = new Date((20 + from[2]), from[1] - 1, from[0]);
                    datatest.setValue(i, 0, date4);
                }

                datatest.removeColumn(1);
                                new google.charts.Bar(document.getElementById('carousel5')).draw(
                        datatest,
                        google.charts.Bar.convertOptions({
                            legend: {position: 'bottom'},
                            
                            height: height,
                            fontName: 'Lato, sans-serif'
                        }));
            }


            if(dataPressure.length !== 1)
            {
                new google.charts.Line(document.getElementById('carousel1')).draw(
                        new google.visualization.arrayToDataTable(dataPressure),
                        google.charts.Line.convertOptions({
                            curveType: 'function',
                            legend: {position: 'bottom'},
                            
                            height: height,
                            fontName: 'Lato, sans-serif'
                        }));
                    }
            if(dataWeight.length !== 1)
            {
                new google.charts.Line(document.getElementById('carousel2')).draw(
                        new google.visualization.arrayToDataTable(dataWeight),
                        google.charts.Line.convertOptions({
                            curveType: 'function',
                            legend: {position: 'bottom'},
                            
                            height: height,
                            fontName: 'Lato, sans-serif'
                        }));
                    }


            if(dataPain.length !== 1){
                new google.charts.Line(document.getElementById('carousel3')).draw(
                        new google.visualization.arrayToDataTable(dataPain),
                        google.charts.Line.convertOptions({
                            curveType: 'function',
                            legend: {position: 'bottom'},
                            
                            height: height,
                            fontName: 'Lato, sans-serif'
                        }));
                    }
                    
            if(dataOxygen.length !== 1)
            {
                new google.charts.Line(document.getElementById('carousel4')).draw(
                        new google.visualization.arrayToDataTable(dataOxygen),
                        google.charts.Line.convertOptions({
                            curveType: 'function',
                            legend: {position: 'bottom'},
                            
                            height: height,
                            fontName: 'Lato, sans-serif'
                        }));
                    }
                    
            

            }
        </script> 

        <div class="row lists">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="smalltitle titleoverview">Blood pressure</div>
                <div class="chart" id="carousel1" style></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="smalltitle titleoverview">Weight</div>
                <div class="chart" id="carousel2" style></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="smalltitle titleoverview">Pain level</div>
                <div class="chart" id="carousel3" style></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="smalltitle titleoverview">Activity</div>
                <div class="chart" id="carousel4" style></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="smalltitle titleoverview">Oxygen</div>
                <div class="chart" id="carousel5" style></div>
            </div>
        </div>   
    </div>
</body>
</html>
