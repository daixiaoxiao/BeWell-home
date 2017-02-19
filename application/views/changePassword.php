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

         </head>
    <body>



        <div id=container class="container">

            <div id=middle class="borders col-sm-12">
                <div id=topPart class="form-group col-sm-12">

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

                </div>
                <div id="welcomeTextForgot" class="form-group col-sm-12">
                    Change Password
                </div>
                <div id=inputs class="form-group col-sm-12">
                    <?php echo form_open('user_authentication/changePassword'); ?>
                    <div id=topOfInputs class="form-group col-sm-12"></div>
                    <div id="changePasswordBox" class="form-group col-sm-12">
                        <input type="password" name="password1" id="email" class="form-control input-lg" placeholder="Enter the password">
                    </div>
                    <div id="changePasswordBox" class="form-group col-sm-12">
                        <input type="password" name="password2" id="email" class="form-control input-lg" placeholder="Confirm password">
                    </div>
                    <div id=buttons class="form-group col-sm-12">
                        <button type="submit" name="change" id=login class="btn">
                            Change password
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>


