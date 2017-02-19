<!DOCTYPE html>
    <body>
        

        <?php echo form_open('PhysicianController/registerPhysician'); ?>
        
        <!-- container -->
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
            <!-- top message -->
            <div class="topMessage">
                Register a new patient
            </div>
            
            <form id="boxInputs" class="form-horizontal col-sm-12" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-4">
                        <input type="text" name="username" class="form-control" placeholder="Enter the username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="firstName" class="form-control" placeholder="Enter the first name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" name="lastName" class="form-control" placeholder="Enter the last name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-4">
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
                <div class="form-group">
                    <label class="col-sm-2 control-label">Birthday</label>
                    <div class="col-sm-4">
                        <input type="text" name="birthday" class="form-control" placeholder="dd-mm-yyyy">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Height</label>
                    <div class="col-sm-4">
                        <input type="text" name="height" class="form-control" placeholder="Enter the height in cm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" placeholder="Enter the email adress">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password1" class="form-control" placeholder="Enter the password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm password</label>
                    <div class="col-sm-4">
                        <input type="password" name="password2" class="form-control" placeholder="Enter the password again">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div id="push"></div>
            </form>

        </div>
        
    </body>
</html>