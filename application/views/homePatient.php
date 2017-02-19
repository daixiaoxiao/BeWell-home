<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">

        <!-- top message -->
        <div class="topMessage">
            Welcome {patient} {Firstname} {/patient}


        </div>

        <!-- task list -->
        <div id="homeLeftSide" class=" col-xs-12 col-sm-12 col-md-5">

            <!-- todolist -->
            <div class="row lists">

                <!-- to do title -->
                <div class="smalltitle col-xs-12">
                    To do
                </div>

                <!-- list of all go to tasks -->
                {todo}
                <div class="col-xs-12 btn btn-primary tasklistbutton" data-toggle="popover" data-trigger="hover" data-content="Go and fulfill this task" onclick="location.href = '{link}'">
                    <input type="hidden" name="idTask" value="{idTask}">
                    <div class="row">
                        <div class="smallitem gotoitem col-xs-2">
                        </div>
                        <div class="smallitem gotoitem col-xs-7">
                            {task}
                        </div>
                        <div class="smallitem gotoitem col-xs-3">
                            Go to
                        </div>
                    </div>
                </div>
                {/todo}
                <!-- /list of all go to tasks -->

                <!-- list of all manual tasks -->
                {manual}
                <div class="col-xs-12 btn btn-primary tasklistbutton" data-toggle="popover" data-trigger="hover" data-content="Please take your measurements on the offline application" onclick="location.href = '{link}'">
                    <input type="hidden" name="idTask" value="{idTask}">
                    <div class="row">
                        <div class="smallitem gotoitem col-xs-2">
                        </div>
                        <div class="smallitem gotoitem col-xs-7">
                            {task}
                        </div>
                        <div class="smallitem gotoitem col-xs-3">
                            Manual
                        </div>
                    </div>
                </div>
                {/manual}
                <!-- /list of all manual tasks -->

                <!-- list of all done tasks -->
                {done}
                <div class="col-xs-12 btn btn-primary tasklistbutton donebutton">
                    <input type="hidden" name="idTask" value="{idTask}">
                    <div class="row">
                        <div class="col-xs-2 smallitem gotoitem">
                            <i class="glyphicon glyphicon-ok"></i>
                        </div>
                        <div class="smallitem gotoitem col-xs-10">
                            {task}
                        </div>    
                    </div>
                </div>
                {/done}
                <!-- list of all done tasks -->

                <!-- /todolist -->
            </div>

            <!-- /tasklist -->
        </div>

        <!-- graphs -->
        <div id="homeRightSide" class="hidden-xs col-sm-12 col-md-6">

            <!-- navtabs -->
            <ul class="nav nav-tabs navgraphs" id="graphtab">
                <li class="active"><a data-toggle="tab" href="#bloodpressure" class="tabtext">Blood pressure</a></li>
                <li><a data-toggle="tab" href="#weight" class="tabtext">Weight</a></li>
                <li><a data-toggle="tab" href="#painlevel" class = "tabtext">Pain level</a></li>
                <li><a data-toggle="tab" href="#activity" class="tabtext">Activity</a></li>
                <li><a data-toggle="tab" href="#oxygen" class="tabtext">Oxygen</a></li>
            </ul>
            <!-- /navtabs -->

            <div class="tab-content">
                <div id="bloodpressure" class="tab-pane fade in active">
                    <div id= "carousel1" class="item active">
                    </div>
                </div>
            </div>

            <!-- /graphs -->
        </div>

        <script type="text/javascript">

/*
 * Script for the graphs in the tabs
 */

            var dateActivity = new Array();
<?php foreach ($activity_data as $data) { ?>
                dateActivity.push('<?php echo $data->date; ?>');
<?php } ?>


            var dataPressure = google.visualization.arrayToDataTable([
                ['Time', 'Systolic Pressure', 'Diastolic Pressure'],
<?php
foreach ($pressure_data as $data) {
    echo '[' . $data->date . ',' . $data->pressureSystolic . ',' . $data->pressureDiastolic . '],';
}
?>
            ]);
            var dataWeight = google.visualization.arrayToDataTable([
                ['Time', 'Weight'],
<?php
foreach ($weight_data as $data) {
    echo '[' . $data->date . ',' . $data->weight . '],';
}
?>
            ]);
            var dataPain = google.visualization.arrayToDataTable([
                ['Time', 'Pain'],
<?php
foreach ($pain_data as $data) {
    echo '[' . $data->date . ',' . $data->painLevel . '],';
}
?>
            ]);
            var dataActivity = google.visualization.arrayToDataTable([
                ['Date', 'Steps', 'calories', 'distance'],
<?php
foreach ($activity_data as $data) {
    echo '[' . $data->date . ',' . $data->steps . ',' . $data->calories . ',' . $data->distance . '],';
}
?>
            ]);
            var dataPain = google.visualization.arrayToDataTable([
                ['Time', 'Pain'],
<?php
foreach ($pain_data as $data) {
    echo '[' . $data->date . ',' . $data->painLevel . '],';
}
?>
            ]);
            var dataOxygen = google.visualization.arrayToDataTable([
                ['Time', 'Oxygen'],
<?php
foreach ($oxygen_data as $data) {
    echo '[' . $data->date . ',' . $data->oxygenSaturation . '],';
}
?>
            ]);

            drawBloodpressure('carousel1', dataPressure, 400, 690);

            $(document).ready(function () {
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    e.preventDefault();
                    var target = $(e.target).attr("href");
                    switch (target) {
                        case '#bloodpressure':
                            drawBloodpressure('carousel1', dataPressure, 400, 690);
                            break;
                        case '#weight':
                            drawWeight('carousel1', dataWeight, 400, 690);
                            break;
                        case '#painlevel':
                            drawPain('carousel1', dataPain, 400, 690);
                            break;
                        case '#activity':
                            drawActivity('carousel1', dataActivity, dateActivity, 400, 690);
                            break;
                        case '#oxygen':
                            drawOxygen('carousel1', dataOxygen, 400, 690);
                            break;
                        default:
                    }


                });
            });


/*
 * Script for the hovering of the tasklist buttons
 */
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });

            $('.popover-dismiss').popover({
                trigger: 'focus'
            });
        </script>

        <!-- /container -->
    </div>

</body>

</html>
