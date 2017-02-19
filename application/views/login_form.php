<html>
    <head>
        <title>BeWell@Home</title>
        
        <!-- FAVICON -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">

        <!-- JS -->
        <script src="<?= base_url() ?>assets/js/jquery.min.js" type="text/javascript"></script>
        
        <!-- BOOTSTRAP -->
        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        
        <!-- CSS -->
        <link href="<?= base_url() ?>assets/css/styleLogin.css" rel="stylesheet" type="text/css"/>

        <!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    --></head>
    <body>



        <div id=container class="container" >

            <div id=middle class="borders col-sm-12">
                <div id=topPart class="form-group col-sm-12">

                    <?php if (!empty($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($message_display)) { ?>
                        <div class="alert alert-info" role="alert">
                            <?php echo $message_display; ?>
                        </div>
                    <?php } ?>

                </div>
                <div id="welcomeText" class="form-group col-sm-12">
                     BeWell@Home
                </div>
                <div id=inputs class="form-group col-sm-12">
                    <?php echo form_open('user_authentication/user_login_process'); ?>
                    <div id=topOfInputs class="form-group col-sm-12"></div>
                    <div id=nameID class="form-group col-sm-12">
                        <input type="text" name="username" id="name" class="form-control input-lg" placeholder="Username"/>
                    </div>
                    <div id=passID class="form-group col-sm-12">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"/>
                    </div>
                    <div id=checkbox class="form-group col-sm-12">
                        <label id="remember_me_text">
                            <input type="checkbox" name="remember_me" id="remember_me"/>
                            Remember me
                        </label>
                    </div>
                    <button type="submit" name="login" id=login class="btn col-sm-12 col-xs-12">
                        Log In
                    </button>
                    <?php echo form_close(); ?>
                    <button type="submit" name="forgot" id=forgot class="btn" onclick="location.href='<?php echo base_url();?>index.php/user_authentication/forgotPassword'">
                        Lost your password?
                    </button>
                </div>
                <div id=buttons class="form-group col-sm-12">



                </div>
            </div>
        </div>
    </body>
</html>


