<body>
    <script>
        function showblock(patientId, firstname, lastname, pain, weight, pulse, bloodSys, bloodDia, product_pic) {
            // assign param values to block html elements
            document.getElementById("messageBut").setAttribute("data-id", "r" + patientId);
            document.getElementById("dataBut").setAttribute("data-id", "r" + patientId);
            document.getElementById("dataProfile").setAttribute("href", "../PhysicianController/overviewPatient/" + patientId);
//          document.getElementById("patientname").innerHTML = firstname.concat(" ", lastname);
            document.getElementById("patientPain").innerHTML = pain;
            document.getElementById("patientWeight").innerHTML = weight;
            document.getElementById("patientPulse").innerHTML = pulse;
            document.getElementById("patientBloodSys").innerHTML = bloodSys;
            document.getElementById("patientBloodDia").innerHTML = bloodDia;
            document.getElementById("imageurl").src = "http://localhost/FinalProject/imagefolder/" + product_pic;
            

                
            var e = document.getElementById("personalPicture");
            if (e.style.display === 'block' || e.style.display === '')
            {
                e.style.display = 'none';

                document.getElementsByName("patientId")[0].style.backgroundColor = '#FFFFFF';
              //  document.getElementById('patientItem').style.backgroundColor = '#FFFFFF';
               // document.getElementById("patientname").style.color = ' #272F32';
            }
            else
            {
                e.style.display = 'block';
                
                document.getElementsByName("patientId")[0].style.backgroundColor = '#9DBDC6';
              // document.getElementById('patientItem').style.backgroundColor = '#9DBDC6';
               // document.getElementById("patientname").style.color = '#FFFFFF';
            }

        }
        function showSliders() {
            var $s0 = $("#range-bloodDia").freshslider({
                range: true,
                step: 1,
                min: 40,
                max: 150,
                value: [document.getElementsByName("pressureDiaDown")[0].value, document.getElementsByName("pressureDiaUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("pressureDiaDown")[0].value = low;
                    document.getElementsByName("pressureDiaUp")[0].value = high;
                }
            });
            var $s1 = $("#range-bloodSys").freshslider({
                range: true,
                step: 1,
                min: 90,
                max: 200,
                value: [document.getElementsByName("pressureSysDown")[0].value, document.getElementsByName("pressureSysUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("pressureSysDown")[0].value = low;
                    document.getElementsByName("pressureSysUp")[0].value = high;
                }
            });
            var $s2 = $("#range-weight").freshslider({
                range: true,
                step: 1,
                min: 0,
                max: 200,
                value: [document.getElementsByName("weightDown")[0].value, document.getElementsByName("weightUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("weightDown")[0].value = low;
                    document.getElementsByName("weightUp")[0].value = high;
                }
            });
            var $s3 = $("#range-pulse").freshslider({
                range: true,
                step: 1,
                min: 40,
                max: 110,
                value: [document.getElementsByName("pulseDown")[0].value, document.getElementsByName("pulseUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("pulseDown")[0].value = low;
                    document.getElementsByName("pulseUp")[0].value = high;
                }
            });
            var $s4 = $("#range-pain").freshslider({
                range: true,
                step: 1,
                min: 0,
                max: 10,
                value: [document.getElementsByName("painDown")[0].value, document.getElementsByName("painUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("painDown")[0].value = low;
                    document.getElementsByName("painUp")[0].value = high;
                }
            });
            var $s5 = $("#range-oxygen").freshslider({
                range: true,
                step: 1,
                min: 80,
                max: 100,
                value: [document.getElementsByName("oxygenDown")[0].value, document.getElementsByName("oxygenUp")[0].value],
                onchange: function (low, high) {
                    document.getElementsByName("oxygenDown")[0].value = low;
                    document.getElementsByName("oxygenUp")[0].value = high;
                }
            });
        }
        
        function darker(x){
             x.style.backgroundColor = '#9DBDC6';
             
        }
        
        function lighter(x){
             x.style.backgroundColor = '#FFFFFF';
        }
    </script>
    <!-- Page container -->
    <div class="container">
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php } ?>

        <div class="topMessage">
            Welcome {namePhysician} {Firstname} {/namePhysician}
        </div>

        <!-- Content area -->
        <div class="content">

            <!-- Noodgevallen -->
            <div class="row">
                <div class="col-md-6">

                    <!--list -->
                    <div class="panel panel-flat lists patientlist">
                        <div class="smalltitle">
                            Require your attention
                        </div>
                        <div class="panel-body"  >
                            {usersWithAlert}
                            <div id="patientItem" name={patientId} onmouseover="darker(this)" onmouseout="lighter(this)">                              
                            <ul>
                                <li class="media">
                                    <div class="media-left media-middle">
                                        <img id="profile_url" src= <?php echo base_url('imagefolder/') . "/" ?>{product_pic}  class="img-profile" alt="patient image">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-heading text-name">
                                            <a id="patientname" href="../PhysicianController/overviewPatient/{patientId}">
                                                {Firstname} {Lastname}
                                            </a>
                                        </div>
                                        <span class="red-warning-text">Alert: {alert}</span>
                                    </div>
                                    <div class="homesolution">
                                        <i class="fa fa-chevron-right fa-3x" id="arow" onclick="showblock(
                                                        '{patientId}',
                                                        '{Firstname}',
                                                        '{Lastname}',
                                                        '{pain}',
                                                        '{weight}',
                                                        '{pulse}',
                                                        '{bloodSys}',
                                                        '{bloodDia}',
                                                        '{product_pic}'
                                                        )"  ></i>
                                    </div>
                                </li>
                            </ul>
                            </div>
                            {/usersWithAlert}
                        </div>
                    </div>
                </div>
                    <div class="col-md-6" id="personalPicture" style="display: none;" >
                        <!-- Detailed view -->
                        <div class="panel-heading" >
                            <h5 class="smalltitle">Detailed view</h5>

                        </div>
                        <div class="panel panel-flat">
                            <div class="tempimage">
                            <img id="imageurl" src="" class="detail-picture homescphyssolution" alt="Detail">
                            </div>
                            
                            <div class="components">
                            <i class="fa fa-envelope-o fa-3x col-xs-4" id="messageBut" data-toggle="modal" data-target="#sendMessageModal" data-id=""></i>
                            <a id="dataProfile" href="" class="nohovercolor"><i class="fa fa-3x fa-line-chart col-xs-4"></i></a>

                            <i class="fa fa-pencil-square-o fa-3x clo-xs-4" id="dataBut" data-toggle="modal" data-target="#editPatientModal" data-id="" ></i>
                            </div>
                            
                           
                                           


                        <div class="row">


                            <div class="panel-heading col-xs-9">
                                <h5 class="panel-title col-xs-12" id="patientname"></h5>
                                <h5 class="smalltitle col-xs-12">Latest measurements</h5>
                                <h5 class="panel-title col-xs-6" id="patienttext">Pain:</h5><h5 class="panel-title col-xs-6" id="patientPain"></h5>
                                <h5 class="panel-title col-xs-6" id="patienttext">Weight:</h5><h5 class="panel-title col-xs-6" id="patientWeight"></h5>
                                <h5 class="panel-title col-xs-6" id="patienttext">Pulse:</h5><h5 class="panel-title col-xs-6" id="patientPulse"></h5>
                                <h5 class="panel-title col-xs-6" id="patienttext">Systolic BP:</h5><h5 class="panel-title col-xs-6" id="patientBloodSys"></h5>
                                <h5 class="panel-title col-xs-6" id="patienttext">Diastolic BP:</h5><h5 class="panel-title col-xs-6" id="patientBloodDia"></h5>
                            </div>

                        </div>
                       </div>       
                    </div>
                </div>
            </div>
        </div>
    
    <div id="sendMessageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send a message</h4>
                </div>
                <div class="modal-body">
                    <script>
                        $('#sendMessageModal').on('show.bs.modal', function (e) {
                            var id = $(e.relatedTarget).data('id');
                            var values = id.split('r');
                            document.getElementById("patientId").value = values[1];
                        });
                    </script>
                    <form id="sendMessage" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/sendMessageHome'); ?>" method="post" enctype="multipart/form-data">               
                        <input type="hidden" id="patientId" name="patientId">
                        <label class="col-xs-5" for="title">Title:</label>

                        <input type="text" name="title" class="input-xlarge col-xs-7">
                        <label class="col-xs-5" for="message">Enter a Message:</label>

                        <textarea name="message" class="input-xlarge  col-xs-7"></textarea>

                        <input class="btn btn-primary modalbutton" type="submit" value="Send!" id="submit">

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>


<!-- Modal -->
<div class="modal fade" id="editPatientModal" role="dialog">
    <div class="modal-dialog">
        <script>
            $('#editPatientModal').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                var values = id.split('r')
                document.getElementById("idPatient").value = values[1];
                $.get("../../index.php/PhysicianController/getThresholdsPaptient/" + values[1] + "/", null, takeData);
            });
            $('#editPatientModal').on('shown.bs.modal', function () {
                showSliders();
            });
            function takeData(data) {
                obj = JSON.parse(data);
                if (obj !== null) {
                    document.getElementsByName("painDown")[0].value = obj[0].painDown;
                    document.getElementsByName("painUp")[0].value = obj[0].painUp;
                    document.getElementsByName("weightDown")[0].value = obj[0].weightDown;
                    document.getElementsByName("weightUp")[0].value = obj[0].weightUp;
                    document.getElementsByName("pulseDown")[0].value = obj[0].pulseDown;
                    document.getElementsByName("pulseUp")[0].value = obj[0].pulseUp;
                    document.getElementsByName("pressureSysDown")[0].value = obj[0].sysDown;
                    document.getElementsByName("pressureSysUp")[0].value = obj[0].sysUp;
                    document.getElementsByName("pressureDiaDown")[0].value = obj[0].diaDown;
                    document.getElementsByName("pressureDiaUp")[0].value = obj[0].diaUp;
                    document.getElementsByName("oxygenDown")[0].value = obj[0].oxygenDown;
                    document.getElementsByName("oxygenUp")[0].value = obj[0].oxygenUp;
                }
            }
        </script>
        <!-- Modal content-->
        <div class="modal-content">
            <div id="modalDiv">
                <div class="profile row">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <div class="h3text">Edit profile</div>
                    </div>
                    <div class="col-md-12">
                        <form id="changeProfile" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/changePatientHome'); ?>" method="post" enctype="multipart/form-data">               
                            <input id="idPatient" type="hidden" name="idPatient">
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Diastolic Pressure
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-bloodDia"></div>
                                    <input name="pressureDiaDown" type="hidden" value="50">
                                    <input name="pressureDiaUp" type="hidden" value="100">
                                </div>
                            </div>
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Systolic Pressure
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-bloodSys"></div>
                                    <input name="pressureSysDown" type="hidden" value="90">
                                    <input name="pressureSysUp" type="hidden" value="200">
                                </div>
                            </div>
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Weight
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-weight"></div>
                                    <input name="weightDown" type="hidden" value="0">
                                    <input name="weightUp" type="hidden" value="200">
                                </div>
                            </div>
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Pulse
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-pulse"></div>
                                    <input name="pulseDown" type="hidden" value="40">
                                    <input name="pulseUp" type="hidden" value="110">
                                </div>
                            </div>
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Pain level
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-pain"></div>
                                    <input name="painDown" type="hidden" value="0">
                                    <input name="painUp" type="hidden" value="10">
                                </div>
                            </div>
                            <div class="row checkboxlist">
                                <div class="col-xs-5">
                                    Oxygen saturation
                                </div>
                                <div class="col-xs-6">
                                    <div id="range-oxygen"></div>
                                    <input name="oxygenDown" type="hidden" value="80">
                                    <input name="oxygenUp" type="hidden" value="100">
                                </div>
                            </div>
                            <div id="inputProfile" class="form-group">
                                <div class="col-sm-offset-7 col-sm-4">
                                    <button type="submit" id="submitButton" class="btn btn-primary modalbutton">Submit</button>
                                </div>
                            </div>
                            <div id="push"></div>
                        </form></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
