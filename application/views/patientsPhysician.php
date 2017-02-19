<!DOCTYPE html>
<script type="text/javascript">
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
</script>
<body>
    <div class="container">
        <?php echo form_close(); ?>
        <?php if (isset($succesMessage)) { ?>
            <div class="alert alert-info" role="alert">
                Successfull
            </div>
        <?php } ?>

        <div class="row">
            <div class="topMessage">
                Registered patients
            </div>
        </div>
        <div class="row lists topbottom-buffer">
            <!--Patient dataTable -->
            <div class="col-md-12">    
                
                <table id="all-patients" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>First Name</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Edit Profile</th>
                            <th>Message</th>
                            <th>Measurements</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        {allPatients}
                        <tr onmouseover="darker(this)" onmouseout="lighter(this)">
                            <td><img src=<?php echo base_url('imagefolder/')."/"  ?>{product_pic} class="img-circle profpic-thumbnail" alt=""></td>
                            <td>{Lastname}</td>
                            <td>{Firstname}</td>
                            <td>{Birthday}</td>
                            <td>{Gender}</td>
                            <td><i class="fa fa-pencil-square-o fa-2x" data-toggle="modal" data-target="#editPatientModal" data-id="r{ID}" ></i></td>
                            <td><i class="fa fa-envelope-o fa-2x" data-toggle="modal" data-target="#sendMessageModal" data-id="r{ID}"></i></td>
                            <td><a href="../PhysicianController/overviewPatient/{ID}" class="nohovercolor"><i class="fa fa-line-chart fa-2x" data-toggle="modal" data-id="r{ID}"></i></a></td>
                            <td>
                                
                                 <button class="btn btn-remover floater" id="delete"  data-MessageId={id} onclick="myDelete({ID})">
                                     <a class="confirm-delete fa fa-trash fa-2x nohovercolor"  ></a>
                                </button>  
                                </a></td>
                        </tr>
                        {/allPatients}
                    <script>
                        function myDelete(clicked_id) {
                                $.get("../../index.php/PhysicianController/deletePatient/" + clicked_id, null, null);
                                $(this).blur();
                                location.href = location.href;
                        }

             function darker(x){
                 x.style.backgroundColor = '#9DBDC6';

            }

            function lighter(x){
                 x.style.backgroundColor = '#FFFFFF';
            }
                    </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     
    

  
    <!-- Modal -->
    <div class="modal fade" id="editPatientModal" role="dialog">
        <div class="modal-dialog">
            <script>
                $('#editPatientModal').on('show.bs.modal', function (e) {
                    var id = $(e.relatedTarget).data('id');
                    document.getElementById("idPatient").value = id.substr(1);
                    $.get("../../index.php/PhysicianController/getThresholdsPaptient/" + id.substr(1) + "/", null, takeData);
                    });
                $('#editPatientModal').on('shown.bs.modal', function () {
                    showSliders();
                });
                function takeData(data) {
                    obj = JSON.parse(data);

                    if (obj !== null)
                    {
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
                            <form id="changeProfile" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/changePatient'); ?>" method="post" enctype="multipart/form-data">               
                                <input id="idPatient" type="hidden" name="idPatient" value = "0">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="sendMessageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="h3text">Send a message</div>
                </div>
                <div class="modal-body">
                    <script>
                        $('#sendMessageModal').on('show.bs.modal', function (e) {
                            var id = $(e.relatedTarget).data('id');
                            var values = id.split('r')
                            document.getElementById("patientId").value = values[1];
                        });
                    </script>
                    <form id="sendMessage" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/sendMessage'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="patientId" name="patientId"  class="input-xlarge">
                        <br>
                        <br>
                        <input type="text" name="title" placeholder="Subject" style="width: 100%" size="30">
                        <br>
                        <br>
                        <textarea name="message" placeholder="Enter your message" style="width: 100%"></textarea>
                        <br>
                        <br>
                        <input class="btn btn-primary modalbutton modalsubmit" type="submit" value="Send" id="submit">
                        <script>
                            $('#sendMessageModal').on('show.bs.modal', function (e) {
                                var id = $(e.relatedTarget).data('id');
                                var values = id.split('r')
                                document.getElementById("patientId").value = values[1];
                            });
                        </script>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    
 
<script type="text/javascript">
        $(document).ready(function () {
            $('#all-patients').DataTable({
                "order": [[1, "desc"]],
                "bLengthChange": false,
                "columns": [
                    {"orderable": false},
                    null,
                    null,
                    null,
                    null,
                    {"orderable": false},
                    {"orderable": false},
                    {"orderable": false},
                    {"orderable": false}
                ]
            });
        });
    </script>
</body>
</html>