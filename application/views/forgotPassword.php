<html>
    <head>
        <title>BeWell@Home</title>
        <link href="<?= base_url() ?>assets/css/styleLogin.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/css/styleLogin.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/js/jquery.min.js" type="text/javascript"></script>
    </head>

    <body>

        <!-- container -->
        <div class="container" >

            
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
                    Recover account
                </div>
                <div id=inputs class="form-group col-sm-12">
                    <?php echo form_open('user_authentication/forgotPassword'); ?>
                    <div id=topOfInputs class="form-group col-sm-12"></div>
                    <div id=nameID class="form-group col-sm-12">
                        <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Enter your email"/>
                    </div>
                    <button type="submit" name="search" id=login class="btn col-sm-5 col-xs-12">
                        Send email
                    </button>

                    <?php echo form_close(); ?>
                    <a href="<?php echo base_url(); ?>index.php" class="button" name="forgot" id="backToLogin">Back to Log In</a>

                </div>
            </div>
            <!-- /container -->
        </div>

    </body>
</html>


