<body>
    {info}
    <!-- container -->
    <div class="container">

        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php } ?>

        <?php if (!empty($message_display)) { ?>
            <div class="alert alert-info" role="alert">
                <p><?php echo $message_display; ?></p>
            </div>
        <?php } ?>



        <!-- top message 
        <div class="topMessage">
            Profile
        </div>-->

        <!-- current profile -->
        <div class="lists col-sm-7">
            <div class="profile row">

                <div class="row profile-heading">
                    <div class="col-sm-4">
                        <img id="profile_url" src= <?php echo base_url('imagefolder/') . "/" ?>{product_pic}  class="img-profilepage" alt="patient image">
                    </div>
                    <div class="col-sm-8 profile-heading-text">
                        {Firstname} {Lastname}
                        <br>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Edit Profile</button>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-sm-3 col-sm-offset-1">Name:</div>
                    <div class="col-sm-8"> {Firstname} {Lastname}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-1">Gender:</div>
                    <div class="col-sm-8"> {Gender} </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-1">Birthdate:</div>
                    <div class="col-sm-8"> {Birthday} </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-1">Email:</div>
                    <div class="col-sm-8"> {Email} </div>
                </div>
                <br>

            </div>


            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <!-- Edit Profile -->
                    <div class="modal-content">
                        <div id="modalDiv">
                            <div class="profile row">
                                <div id="assistant" class="smalltitle">Change Profile</div>
                                <div class="col-md-12">
                                    <form id="changeProfile" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/profilePhysician'); ?>" method="post" enctype="multipart/form-data">               
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="firstname" class="form-control" value="{Firstname}">
                                            </div>
                                        </div>

                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="lastname" class="form-control" value="{Lastname}">
                                            </div>
                                        </div>

                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Gender</label>
                                            <div class="col-sm-8">
                                                <div class="dropdown">
                                                    <input type="hidden" name="gender" id="gender" value="{Gender}">
                                                    <button id="testButton" class="btn btn-default form-control dropdown-toggle" data-toggle="dropdown" name="gender"> {Gender}
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" id="Male">Male</a></li>
                                                        <li><a href="#" id="Female">Female</a></li>
                                                        <li><a href="#" id="Other">Other</a></li>
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

                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Height</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="height" class="form-control" value="{Height}">
                                            </div>
                                        </div>
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Birthday</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="birthday" class="form-control" value="{Birthday}">
                                            </div>
                                        </div>
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">E-mail</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" class="form-control" value="{Email}">
                                            </div>
                                        </div>
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Old Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">New Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password1" class="form-control" placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <div id="inputProfile" class="form-group">
                                            <label class="col-sm-4 control-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password2" class="form-control" placeholder="Confirm password">
                                            </div>
                                        </div>

                                        <div id="inputProfile" class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" id="submitButton" class="btn btn-primary modalbutton">Submit</button>
                                            </div>
                                        </div>
                                        <div id="push"></div>
                                    </form>
                                </div>
                                </div>
                            <div class="profile row">
                                    <br>
                                <div class="col-md-12">
                                    <form id="changeProfilePic" class="form-horizontal col-sm-12" role="form" action="<?php echo site_url('PhysicianController/upload_file'); ?>" method="post" enctype="multipart/form-data"> 
                                        <div id="inputProfilePic" class="form-group">
                                            <label class="col-sm-4 control-label">Choose Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="product_pic" class="form-control" placeholder="Choose an image">
                                            </div>
                                        </div>
                                        <div id="inputProfilePic" class="form-group align-right">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Upload picture</button>
                                            </div>
                                        </div>
                                        <div id="push"></div>
                                    </form>
                                </div>
                            </div></div></div>

                </div>
            </div>
        </div>

        <!-- assistents -->
        <div class="lists col-sm-4 col-sm-offset-1">
            <?php if (!empty($assistants)) { ?>        
                <div id="assistant" class="smalltitle">Assistents</div>
                <div class="profile row">
                    {assistants}
                    <div class="col-sm-4">
                        <div>
                            <img id="profile_url" src= <?php echo base_url('imagefolder/') . "/" ?>{product_pic}  class="img-assistent" alt="{Firstname}">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div id="assistant_name">
                            <h4>
                                {Firstname} {Lastname}
                            </h4>
                            <h5>
                                {Email}
                            </h5>
                        </div>
                    </div>
                    {/assistants}
                </div>
            <?php } ?>
        </div>
    </div>
    {/info}
</body>
</html>
