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
        <script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/freshslider.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/jquery.tokeninput.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/graphsPhysician.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/js/graphs.js" type="text/javascript"></script>

        <!-- BOOTSTRAP -->
        <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>

        <!-- CSS -->
        <link href="<?php echo base_url()?>assets/css/navbar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/physician.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url()?>assets/css/freshslider.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/css/token-input.css" rel="stylesheet" type="text/css"/>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- Data Tables -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
        

        <!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="http://www.gstatic.com/charts/loader.js"></script>
        <script> google.charts.load("43",{packages:['line','bar','corechart']}); </script>



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
                            <a href="<?php echo base_url()?>index.php/PhysicianController/homePhysician" title="Home">BeWellAtHome</a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="header-nav">
                        <ul class="nav navbar-nav">
                            {menu_items}
                            <li class="navListPhysician" ><a href="../{link}" class="{className}" title="{title}">{name}</a></li>
                            {/menu_items}
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            {menu_items_profile}
                            <li class="navProfile"><a href="../{link}" class="{className}" title="{title}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                            {/menu_items_profile}
                            
                            {menu_items_logout}
                            <li class="navLogout"><a href="../{link}" class="{className}" title="{title}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
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