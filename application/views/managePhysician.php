<!DOCTYPE html>
<html lang="en">
    <head>
        <script type="text/javascript">
            $(document).ready(function () {
                //create table
                var $s0 = $("#range-bloodDia").freshslider({
                    range: true,
                    step: 1,
                    min: 40,
                    max: 150,
                    value: [40, 150],
                    onchange: function (low, high) {
                        //alert('changed');
                        document.getElementsByName("pressureDiaDown")[0].value = low;
                        document.getElementsByName("pressureDiaUp")[0].value = high;
                    }
                });

                var $s1 = $("#range-bloodSys").freshslider({
                    range: true,
                    step: 1,
                    min: 90,
                    max: 200,
                    value: [90, 200],
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
                    value: [0, 200],
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
                    value: [40, 110],
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
                    value: [0, 10],
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
                    value: [80, 100],
                    onchange: function (low, high) {
                        document.getElementsByName("oxygenDown")[0].value = low;
                        document.getElementsByName("oxygenUp")[0].value = high;
                    }
                });
            });</script>
    </head>
    <body>



        <div class="container">
            <?php if (isset($succes)) { ?>
                <div class="alert alert-info" role="alert">
                    <p><?php echo $succes; ?></p>
                </div>
            <?php } ?>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php } ?>           

            <div class="row">
                <div class="topMessage">
                    Manage patients and personnel
                </div>
            </div>
            <!-- Filter patients -->

            <div class="row lists">
                <div class="col-md-12 filterblock">

                    <!--list -->
                    <div class="panel-heading resultstitle">
                        <div class="panel-title smalltitle resultstitle">Results</div>

                    </div>
                    <div>

                        <ul class="nav nav-tabs managetabs">
                            <li class="active"><a data-toggle="tab" href="#register" class="tabtext">Add Patient</a></li>
                            <li><a data-toggle="tab" href="#staff" class = "tabtext">Add New Staff Members</a></li>
                            <li><a data-toggle="tab" href="#staff2" class = "tabtext">Manage Staff Members</a></li>
                        </ul>
                        <div class="tab-content">

                            <div id="register" class="tab-pane fade in active">
                                <?php echo form_open('PhysicianController/registerPhysician'); ?>
                                <form id="boxInputs" class="form-horizontal col-sm-12" role="form">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <label class="panel-title smalltitle resultstitle titlebold">Enter information of the patient</label>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makeapatientexplain makepatientexplain">Username</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="username" class="form-control makeapatientexplain" placeholder="Enter the username">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="firstName" class="form-control" placeholder="Enter the first name">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Last Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="lastName" class="form-control" placeholder="Enter the last name">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Gender</label>
                                            <div class="col-sm-5">
                                                <div class="dropdown">
                                                    <button id="testButton" class="btn btn-default form-control dropdown-toggle" data-toggle="dropdown"> Select gender
                                                        <span class="caret"></span></button>
                                                    <input type="hidden" name="gender" id="gender" value="">
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Male</a></li>
                                                        <li><a href="#">Female</a></li>
                                                        <li><a href="#">Other</a></li>
                                                    </ul>

                                                </div>

                                                <script type="text/javascript">
                                                    $(function () {

                                                        $(".dropdown-menu").on('click', 'li a', function () {
                                                            $("#testButton:first-child").text($(this).text());
                                                            $("#testButton:first-child").val($(this).text());
                                                            document.getElementById("gender").value = $(this).text();
                                                        });

                                                    });
                                                </script>

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Birthday</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="birthday" class="form-control" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Height</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="height" class="form-control" placeholder="Enter the height in cm">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="email" name="email" class="form-control" placeholder="Enter the email adress">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Password</label>
                                            <div class="col-sm-5">
                                                <input type="password" name="password1" class="form-control" placeholder="Enter the password">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Confirm password</label>
                                            <div class="col-sm-5">
                                                <input type="password" name="password2" class="form-control" placeholder="Enter the password again">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        <div id="push"></div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="panel-title smalltitle resultstitle">Set thresholds patient</div>
                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Diastolic Pressure
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-bloodDia"></div>
                                                <input type="hidden" name="pressureDiaDown" value="40">
                                                <input type="hidden" name="pressureDiaUp" value="150">
                                            </div>
                                        </div>

                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Systolic Pressure
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-bloodSys"></div>
                                                <input type="hidden" name="pressureSysDown" value="0">
                                                <input type="hidden" name="pressureSysUp" value="200">
                                            </div>
                                        </div>                            

                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Weight
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-weight"></div>
                                                <input type="hidden" name="weightDown" value="40">
                                                <input type="hidden" name="weightUp" value="110">
                                            </div>
                                        </div>

                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Pulse
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-pulse"></div>
                                                <input type="hidden" name="pulseDown" value="0">
                                                <input type="hidden" name="pulseUp" value="10">
                                            </div>
                                        </div>

                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Pain level
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-pain"></div>
                                                <input type="hidden" name="painDown" value="80">
                                                <input type="hidden" name="painUp" value="100">
                                            </div>
                                        </div>

                                        <div class="row checkboxlist">
                                            <div class="col-xs-5 boldname">
                                                Oxygen saturation
                                            </div>

                                            <div class="col-xs-6">
                                                <div id="range-oxygen"></div>
                                                <input type="hidden" name="oxygenDown" value="">
                                                <input type="hidden" name="oxygenUp" value="">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php echo form_close(); ?>
                            </div>



                            <div id="staff" class="tab-pane fade">
                                    <?php echo form_open('PhysicianController/registerPhysicianStaffMember'); ?>

                                <form id="staffregister" class="form-horizontal col-sm-12 staffregister" role="form">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <label class="panel-title smalltitle resultstitle titlebold">Enter information of the assistant</label>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makeapatientexplain makepatientexplain">Username</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="username" class="form-control makeapatientexplain" placeholder="Enter the username">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="firstName" class="form-control" placeholder="Enter the first name">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Last Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="lastName" class="form-control" placeholder="Enter the last name">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Gender</label>
                                            <div class="col-sm-5">
                                                <div class="dropdown">
                                                    <button id="testButton" class="btn btn-default form-control dropdown-toggle" data-toggle="dropdown"> Select gender
                                                        <span class="caret"></span></button>
                                                    <input name="genderStaff" id="genderStaff" value="" type="hidden">
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Male</a></li>
                                                        <li><a href="#">Female</a></li>
                                                        <li><a href="#">Other</a></li>
                                                    </ul>

                                                </div>

                                                <script type="text/javascript">
                                                    $(function () {

                                                        $(".dropdown-menu").on('click', 'li a', function () {
                                                            $("#testButton:first-child").text($(this).text());
                                                            $("#testButton:first-child").val($(this).text());
                                                            document.getElementById("genderStaff").value = $(this).text();
                                                        });

                                                    });
                                                </script>

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Birthday</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="birthday" class="form-control" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="email" name="email" class="form-control" placeholder="Enter the email adress">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Password</label>
                                            <div class="col-sm-5">
                                                <input type="password" name="password1" class="form-control" placeholder="Enter the password">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label makepatientexplain">Confirm password</label>
                                            <div class="col-sm-5">
                                                <input type="password" name="password2" class="form-control" placeholder="Enter the password again">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        <div id="push"></div>

                                    </div>
                                </form>
                                <?php echo form_close(); ?>
                            </div>
                            <div id="staff2" class="tab-pane fade">
                                
                                 <div class="col-md-6">
                                <?php if (!empty($assistants)) { ?> 
                                <div id="assistant" class="smalltitle">Delete an assistent</div>
                                <table id="all-patients" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {assistants}
                                        <tr>
                                            <td><img id="profile_url" src= <?php echo base_url('imagefolder/') . "/" ?>{product_pic}  class="img-assistent" alt="{Firstname}"></td>
                                            <td>{Username}</td>
                                            <td>{Firstname}</td>
                                            <td>{Lastname}</td>
                                            <td><a href="../PhysicianController/deleteAssistantOfPhysician/{ID}" class="nohovercolor"><i class="fa fa-user-times fa-2x" data-toggle="modal" data-id="r{ID}"></i></a></td>
                                        </tr>
                                        {/assistants}
                                    </tbody>
                                </table>
                                <?php } ?>
                                
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </body>

</html>
