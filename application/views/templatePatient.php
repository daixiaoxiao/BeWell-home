<!DOCTYPE html>
                        <?php
                $session_id  = $this->session->userdata('userId');
                if (empty($session_id)) {
                    redirect(base_url()); 
        }
?>

<html>
    <head>
        <title>{page_title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="BeWellAtHome" />
        <meta name="description"
              content="Team 4" />

        <!-- FAVICON -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon">

        <!-- JS -->
        <script src="<?php echo base_url()?>assets/js/graphs.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/bootstrap-slider.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/material.js" type="text/javascript"></script>
        
        <!-- BOOTSTRAP -->
        <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- CSS -->
        <link rel='stylesheet' type='text/css' href='<?php echo base_url()?>assets/css/styleInfoGrid.css' />
        <link href="<?php echo base_url()?>assets/css/patient.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/navbar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/bootstrap-slider.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/material.css" rel="stylesheet" type="text/css"/>
        
        <script type='text/javascript' src='<?php echo base_url()?>assets/js/infogrid.js'></script>   

        <!--Graphs-->
        <script type="text/javascript" 
           src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript"
              src="https://www.google.com/jsapi?autoload={
                'modules':[{
                  'name':'visualization',
                  'version':'1',
                  'packages':['line']
                }]
              }"></script>

                  <script type="text/javascript"
              src="https://www.google.com/jsapi?autoload={
                'modules':[{
                  'name':'visualization',
                  'version':'1',
                  'packages':['bar']
                }]
              }"></script>
              
   
    </head>

    <body>
        <div id="wrapper"> 
            <nav class="navbar navbar-default navbar-fixed-top">
                <div id="navContainer" class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>

                        </div>
                        <div class="navbar-brand">
                            <a href="<?php echo base_url()?>index.php/PatientController/homePatient" title="Home">BeWellAtHome</a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="header-nav">
                        
                        <ul class="nav navbar-nav">
                            {menu_items}
                            <li class="navListPatient" ><a href="{link}" class="{className}" title="{title}">{name}</a></li>
                            {/menu_items}
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            
                              {menu_items_message}
                            <li class="navLogout"><a href="{link}" class="{className}" title="{title}"><span class="material-icons mdl-badge" data-badge="{number}" > <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span></a>
                            </li>
                            <!--<li class="navLogoutSmall"><a href="{link}">{name}</a></li>-->
                            {/menu_items_message}
                            
                            {menu_items_profile}
                            <li class="navProfile"><a href="{link}" class="{className}" title="{title}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                            <!--<li class="navProfileSmall"><a href="{link}">{name}</a></li>-->
                            {/menu_items_profile}
                            
                            {menu_items_logout}
                            <li class="navLogout"><a href="{link}" class="{className}" title="{title}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                            <!--<li class="navLogoutSmall"><a href="{link}">{name}</a></li>-->
                            {/menu_items_logout}
                            
                            
                            

                            
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="page">
                <section>
                    <section>
                        {content}
                        <hr />
                    </section>
                </section>
                <!--<footer>
                    <p>Copyright © 2015 WebApps Team4. All Rights Reserved.  <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
                </footer>-->
            </div>
        </div>
    </body>
</html>