<!DOCTYPE html>
<html lang="en">
    <head>
        <script type="text/javascript">
            //remove from array function
            function removeA(arr) {
                var what, a = arguments, L = a.length, ax;
                while (L > 1 && arr.length) {
                    what = a[--L];
                    while ((ax = arr.indexOf(what)) !== -1) {
                        arr.splice(ax, 1);
                    }
                }
                return arr;
            }



            var $ids = [];
            var $toAdd = [];
            var $dataSet = [];
            var $bloodDiaIds = [];
            var $bloodSysIds = [];
            var $weightIds = [];
            var $pulseIds = [];
            var $painIds = [];
            var $oxygenIds = [];
            var dt;
            var $bloodActiveDia = false;
            var $bloodActiveSys = false;
            var $weightActive = false;
            var $pulseActive = false;
            var $painActive = false;
            var $oxygenActive = false;


            $(document).ready(function () {
                var $s0 = $("#range-bloodDia").freshslider({
                    range: true,
                    step: 5,
                    min: 40,
                    max: 150,
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $("#bloodDia").prop('checked', true);
                            $bloodActiveDia = true;
                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.blood_pressure/pressureDiastolic/pressureDiastolic/" + low + "/" + high, null, addIDBloodDia);
                        }
                    }
                });

                var $s1 = $("#range-bloodSys").freshslider({
                    range: true,
                    step: 5,
                    min: 90,
                    max: 200,
                    value: [90, 200],
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $bloodActiveSys = true;
                            $("#bloodSys").prop('checked', true);
                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.blood_pressure/pressureSystolic/pressureSystolic/" + low + "/" + high, null, addIDBloodSys)
                        }
                    }
                });


                var $s2 = $("#range-weight").freshslider({
                    range: true,
                    step: 1,
                    min: 0,
                    max: 200,
                    value: [0, 200],
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $weightActive = true;
                            $("#weight").prop('checked', true);
                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.scale/weight/weight/" + low + "/" + high, null, addIDWeight);
                        }
                    }
                });
                var $s3 = $("#range-pulse").freshslider({
                    range: true,
                    step: 1,
                    min: 40,
                    max: 110,
                    value: [40, 110],
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $pulseActive = true;
                            $("#pulse").prop('checked', true);

                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pulse_oxygen/pulse/pulse/" + low + "/" + high, null, addIDPulse);
                        }
                    }
                });
                var $s4 = $("#range-pain").freshslider({
                    range: true,
                    step: 1,
                    min: 0,
                    max: 10,
                    value: [0, 10],
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $painActive = true;
                            $("#pain").prop('checked', true);
                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pain_diary/painLevel/painLevel/" + low + "/" + high, null, addIDPain);
                        }
                    }
                });
                var $s5 = $("#range-oxygen      ").freshslider({
                    range: true,
                    step: 1,
                    min: 80,
                    max: 100,
                    value: [80, 100],
                    onchange: function (low, high) {
                        if (dt !== undefined)
                        {
                            $oxygenActive = true;
                            $("#oxygen").prop('checked', true);
                            $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pulse_oxygen/oxygenSaturation/oxygenSaturation/" + low + "/" + high, null, addIDOxygen);
                        }
                    }
                });



                //create table
                dt = $('#filtered-patients').DataTable({
                    data: $dataSet,
                    "bLengthChange": false,
                    columns: [
                        {title: "Name"},
                        {title: "First Name"},
                        {title: "Birthday"},
                        {title: "Gender"}
                    ], "fnCreatedRow": function (nRow, aData, iDataIndex) {
                        $(nRow).attr('id', 'r' + aData[4]);
                    }
                });





                $("#bloodDia").click(function () {
                    if ($("#bloodDia").prop('checked') === true) {
                        $bloodActiveDia = true;
                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.blood_pressure/pressureDiastolic/pressureDiastolic/" + $s0.getValue()[0] + "/" + $s0.getValue()[1], null, addIDBloodDia);
                    } else {
                        $bloodActiveDia = false;
                        $bloodDiaIds = [];
                    }
                    $(this).blur();
                });

                $("#bloodSys").click(function () {

                    if ($("#bloodSys").prop('checked') === true) {
                        $bloodActiveSys = true;

                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.blood_pressure/pressureSystolic/pressureSystolic/" + $s1.getValue()[0] + "/" + $s1.getValue()[1], null, addIDBloodSys);
                    } else {
                        $bloodActiveDia = false;
                        $bloodSysIds = [];
                    }
                    $(this).blur();
                });




                $("#weight").click(function () {
                    if ($("#weight").prop('checked') === true) {
                        $weightActive = true;
                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.scale/weight/weight/" + $s2.getValue()[0] + "/" + $s2.getValue()[1], null, addIDWeight);
                    } else {
                        $weightIds = [];
                        $weightActive = false;
                    }
                    $(this).blur();
                });

                $("#pulse").click(function () {
                    if ($("#pulse").prop('checked') === true) {
                        $pulseActive = true;
                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pulse_oxygen/pulse/pulse/" + $s3.getValue()[0] + "/" + $s3.getValue()[1], null, addIDPulse);
                    } else {
                        $pulseActive = false;
                        $pulseIds = [];
                    }
                    $(this).blur();
                });
                $("#pain").click(function () {
                    if ($("#pain").prop('checked') === true) {
                        $painActive = true;
                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pain_diary/painLevel/painLevel/" + $s4.getValue()[0] + "/" + $s1.getValue()[1], null, addIDPain);
                    } else {
                        $painActive = false;
                        $painIds = [];
                    }
                    $(this).blur();
                });
                $("#oxygen").click(function () {
                    if ($("#oxygen").prop('checked') === true) {
                        $oxygenActive = true;
                        $.get("../../index.php/PhysicianController/getPatientGroup/a15_web04.pulse_oxygen/oxygenSaturation/oxygenSaturation/" + $s5.getValue()[0] + "/" + $s5.getValue()[1], null, addIDOxygen);
                    } else {
                        $oxygenActive = false;
                        $oxygenIds = [];
                    }
                    $(this).blur();
                });
                //Get input, act accordingly
                $("input[type=button]").click(function () {
                    var arr = [];
                    if ($(this).attr("id") === "updatePatientList")
                    {
                        arr = $(this).siblings("input[type=text]").tokenInput("get");
                    }

                    //add each bloodId to toAdd if it's not allready in it
                    $.each($bloodDiaIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });

                    $.each($bloodSysIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });

                    $.each($weightIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });
                    $.each($pulseIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });
                    $.each($painIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });
                    $.each($oxygenIds, function (i, obj) {
                        if ($.inArray(obj, $toAdd) === -1)
                        {
                            $toAdd.push(obj);
                        }
                    });
                    //Add all individual ids who aren't allready in toAdd
                    $.each(arr, function (i, obj) {
                        if ($.inArray(obj.id, $toAdd) === -1)
                        {
                            $toAdd.push(obj.id);
                        }
                    });
                    //1. remove id from ids which are NOT in toAdd and remove them from table
                    for (var i = $ids.length - 1; i >= 0; i--) {
                        if ($.inArray($ids[i], $toAdd) === -1)
                        {
                            dt.row($("#r" + $ids[i])).remove().draw(false);
                            removeA($ids, $ids[i]);
                        }
                    }
                    ;
                    // 2. remove toAdds who ARE in ids
                    for (var i = $toAdd.length - 1; i >= 0; i--) {
                        if ($.inArray($toAdd[i], $ids) !== -1)
                        {
                            //dt.row($("#r" + obj)).remove().draw( false );
                            removeA($toAdd, $toAdd[i]);
                        }
                    }
                    ;
                    //3. add remaining toAdd's to list and ids
                    $.each($toAdd, function (i, obj) {
                        $ids.push(obj);
                        $.get("../../index.php/PhysicianController/getPatient/" + obj, null, addPatient);
                    });
                    //4. clear toAdd
                    $toAdd = [];
                    $(this).blur();

                    document.getElementById("actualDataTable").style.display = "inline";
                    document.getElementById("actualDataEnter").style.display = "inline";
                });

                function addIDBloodDia(data) {

                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $bloodDiaIds) === -1)
                            {
                                $bloodDiaIds.push(obj.patientId);
                            }
                        });
                    }
                }

                function addIDBloodSys(data) {

                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $bloodSysIds) === -1)
                            {
                                $bloodSysIds.push(obj.patientId);
                            }
                        });
                    }
                }

                function addIDWeight(data) {
                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $weightIds) === -1)
                            {
                                $weightIds.push(obj.patientId);
                            }
                        });
                    }
                }

                function addIDPulse(data) {
                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $pulseIds) === -1)
                            {
                                $pulseIds.push(obj.patientId);
                            }
                        });
                    }
                }

                function addIDPain(data) {
                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $painIds) === -1)
                            {
                                $painIds.push(obj.patientId);
                            }
                        });
                    }
                }

                function addIDOxygen(data) {
                    data = JSON.parse(data);
                    if (data !== null)
                    {
                        $.each(data, function (i, obj) {
                            if ($.inArray(obj.patientId, $oxygenIds) === -1)
                            {
                                $oxygenIds.push(obj.patientId);
                            }
                        });
                    }
                }


                function addPatient(data) {
                    data = JSON.parse(data);
                    dt.row.add([data[0].Lastname, data[0].Firstname, data[0].Birthday, data[0].Gender, data[0].ID]).draw(false);
                }




            });</script>

    </head>

    <body>
        <div class="container">

            <div class="row">
                <div class="topMessage">
                    Generate data of a list of patients
                </div>
            </div>

            <!-- Filter patients -->
            <div id="dataContainer" class="row">
                <!-- Select by name -->
                <div id="leftDivData" class="col-sm-5 lists">

                    <!--                </div>-->
                    <!-- Select by measurements -->
                    <!--                <div class="col-sm-6 lists">-->

                    <!--list -->
                    <div class="panel-heading smalltitle tasks123">
                        1.A Generate a list of patients by criteria
                    </div>
                    <div class="panel panel-flat">


                        <div class="panel-body">

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="bloodDia"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Diastolic Pressure (mm Hg)
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-bloodDia"></div>
                                </div>
                            </div>

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="bloodSys"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Systolic Pressure (mm Hg)
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-bloodSys"></div>
                                </div>
                            </div>                            

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="weight"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Weight (Kg)
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-weight"></div>
                                </div>
                            </div>

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="pulse"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Pulse (Beats per minute)
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-pulse"></div>
                                </div>
                            </div>

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="pain"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Pain level
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-pain"></div>
                                </div>
                            </div>

                            <div class="row checkboxlist">
                                <div class="col-xs-1">
                                    <label><input type="checkbox" id="oxygen"  class="checkbox" value=""></label>
                                </div>
                                <div class="col-xs-5">
                                    Oxygen saturation (percent)
                                </div>

                                <div class="col-xs-6 dataslider">
                                    <div id="range-oxygen"></div>
                                </div>
                            </div>

                            <input id="updatePatientList1" type="button" value="Generate list" class="btn btn-primary" />

                        </div>


                    </div>

                    <div class="panel-heading smalltitle tasks123">
                        1.B Add individual patients by name
                    </div>

                    <div class="row">
                        <div class="col-md-12 oneB">
                            <div>
                                <input type="text" id="searchbar" name="blah" />
                                <input id="updatePatientList" type="button" value="Add Patients" class="btn btn-primary" />
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#searchbar").tokenInput("../../searchbar.php", {
                                            preventDuplicates: true
                                        });
                                    });</script>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="rightDivData" class="col-sm-6 lists">  
                    <!-- Selected patients -->
                    <div id="selectedPatients">

                        <!--list -->
                        <div class="panel-heading rightblock">
                            <div class="panel-title smalltitle">2. Check if patient list is complete</div>

                        </div>

                        <div id="actualDataTable" class="panel panel-flat">


                            <table id="filtered-patients" class="table table-striped" cellspacing="0" width="100%"> </table>


                        </div>
                    </div>
                </div>
                <div id="rightDivData1" class="col-sm-6 lists">
                    <!-- Results -->
                    <div id="dataGraphs" >

                        <!--list -->
                        <div class="panel-heading rightblock">
                            <div class="panel-title smalltitle">3. Select data to export</div>
                        </div>
                        
                        <div id="actualDataEnter" class="panel panel-flat">


                            <ul class="nav nav-pills text-padding-left" id="graphtab">
                                <li class="active"><a data-toggle="tab" href="#bloodpressureChart" class="tabtext">Blood pressure</a></li>
                                <li><a data-toggle="tab" href="#weightChart" class="tabtext">Weight</a></li>
                                <li><a data-toggle="tab" href="#painlevelChart" class = "tabtext">Pain level</a></li>
                                <li><a data-toggle="tab" href="#activityChart" class="tabtext">Activity</a></li>
                                <li><a data-toggle="tab" href="#oxygenChart" class="tabtext">Oxygen</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="bloodpressureChart" class="tab-pane fade in active text-padding-left">
                                    <label for="sel1">Select number of measurements</label>
                                    <input id="nrData" type="number" value="5" min="0" name="demo1">
                                    <div class="tab-content">
                                        <div id="bloodpressure" class="tab-pane fade in active">
                                            <div id= "carousel1" class="item active">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="export" class="btn btn-primary action-button">Export Data</button>

                            </div>

                        </div>

                        <!-- /list -->

                    </div>
                </div>
                <!-- /list -->
            </div>


        </div>
        <script>
            var $dataPressure;
            var $dataWeight;
            var $dataPain;
            var $dataActivity;
            var $dataOxygen;
            var $dataToExport;
                
                
                $("#export").click(function () {
                    var csv;
                    var nrData = document.getElementById('nrData').value;
                    if(nrData<0)
                    {
                        nrData = 0;
                    }
                    var promises=[];
      var current_tab = $('.nav-pills .active > a').attr('href');
        switch(current_tab){
            case '#bloodpressureChart':
                         $dataPressure = new google.visualization.DataTable();
                         $dataPressure.addColumn('number', 'pressure1');
                         $dataPressure.addColumn('number', 'pressure2');
                     for (var i = $ids.length - 1; i >= 0; i--) {
                            var request = ($.get("../../index.php/PhysicianController/getBloodData/" + $ids[i]+"/" +nrData, null, addBlood));
                            promises.push(request);
                        }

                        $.when.apply(null, promises).done(function () {
                            if ($dataPressure !== null)
                            {
                                csv = google.visualization.dataTableToCsv($dataPressure);
                            }
                            if (csv !== null)
                            {
                                downloadCSV(csv);
                                csv = null;
                            }
                        });
                        break;
                    case '#weightChart':
                        $dataWeight = new google.visualization.DataTable();
                        $dataWeight.addColumn('number', 'Weight');
                        for (var i = $ids.length - 1; i >= 0; i--) { //change this to a normal each!!!

                            var request = $.get("../../index.php/PhysicianController/getWeightData/" + $ids[i] + "/" + nrData, null, addWeight);
                            promises.push(request);
                        }

                        $.when.apply(null, promises).done(function () {
                            if ($dataWeight !== null)
                            {
                                csv = google.visualization.dataTableToCsv($dataWeight);
                            }
                            if (csv !== null)
                            {
                                downloadCSV(csv);
                                csv = null;
                            }
                        });


                        break;
                    case '#painlevelChart':
                        $dataPain = new google.visualization.DataTable();
                        $dataPain.addColumn('number', 'painLevel');
                        for (var i = $ids.length - 1; i >= 0; i--) { //change this to a normal each!!!

                            var request = $.get("../../index.php/PhysicianController/getPainData/" + $ids[i] + "/" + nrData, null, addPain);
                            promises.push(request);
                        }

                        $.when.apply(null, promises).done(function () {
                            if ($dataPain !== null)
                            {
                                csv = google.visualization.dataTableToCsv($dataPain);
                            }
                            if (csv !== null)
                            {
                                downloadCSV(csv);
                                csv = null;
                            }
                        });

                        break;
                    case '#activityChart':
                        $dataActivity = new google.visualization.DataTable();
                        $dataActivity.addColumn('number', 'Steps');
                        $dataActivity.addColumn('number', 'Calories');
                        $dataActivity.addColumn('number', 'Distance');
                        for (var i = $ids.length - 1; i >= 0; i--) { //change this to a normal each!!!

                            var request = $.get("../../index.php/PhysicianController/getActivityData/" + $ids[i] + "/" + nrData, null, addActivity);
                            promises.push(request);
                        }
                        $.when.apply(null, promises).done(function () {
                            if ($dataActivity !== null)
                            {
                                csv = google.visualization.dataTableToCsv($dataActivity);
                            }
                            if (csv !== null)
                            {
                                downloadCSV(csv);
                                csv = null;
                            }
                        });

                        break;
                    case '#oxygenChart':
                        $dataOxygen = new google.visualization.DataTable();
                        $dataOxygen.addColumn('number', 'Oxygenlevel');
                        for (var i = $ids.length - 1; i >= 0; i--) { //change this to a normal each!!!

                            var request = $.get("../../index.php/PhysicianController/getOxygenData/" + $ids[i] + "/" + nrData, null, addOxygen);
                            promises.push(request);
                        }

                        $.when.apply(null, promises).done(function () {
                            if ($dataOxygen !== null)
                            {
                                csv = google.visualization.dataTableToCsv($dataOxygen);

                            }
                            if (csv !== null)
                            {
                                downloadCSV(csv);
                                csv = null;
                            }
                        });

                        break;
                }
                $(this).blur();
            });

            function addBlood(data) {
                data = JSON.parse(data);
                if (data !== null)
                {
                    $.each(data, function (i, obj) {
                        $dataPressure.addRow([parseInt(obj.pressureSystolic), parseInt(obj.pressureDiastolic)]);
                    });

                }
            }

            function addWeight(data) {
                data = JSON.parse(data);
                if (data !== null)
                {
                    $.each(data, function (i, obj) {
                        $dataWeight.addRow([parseInt(obj.weight)]);

                    });

                }
            }

            function addPain(data) {
                data = JSON.parse(data);
                if (data !== null)
                {
                    $.each(data, function (i, obj) {
                        $dataPain.addRow([parseInt(obj.painLevel)]);

                    });
                }
            }

            function addActivity(data) {
                data = JSON.parse(data);
                if (data !== null)
                {
                    $.each(data, function (i, obj) {
                        $dataActivity.addRow([parseInt(obj.steps), parseInt(obj.calories), parseInt(obj.distance)]);

                    });

                }
            }

            function addOxygen(data) {
                data = JSON.parse(data);
                if (data !== null)
                {
                    $.each(data, function (i, obj) {
                        $dataOxygen.addRow([parseInt(obj.oxygenSaturation)]);
                    });
                }
            }

        </script>


    </body>

</html>