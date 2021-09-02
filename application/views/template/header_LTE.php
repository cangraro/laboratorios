<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Equipos laboratorio</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminlte/AdminLTE.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminlte/skins/_all-skins.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css" type="text/css">       
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker3.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-filestyle.min.css" type="text/css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilos.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-tagsinput.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flipclock.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/picker/default.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/DateTimePicker.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css" type="text/css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" type="text/css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/awesome-bootstrap-checkbox.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jWaitingModal.css" type="text/css">
    </head>
    <body class="hold-transition skin-black-light sidebar-mini sidebar-collapse">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>        
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/adminlte/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/locales/bootstrap-datepicker.es.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.placeholder.js"></script>        
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/localization/messages_es.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-filestyle.min.js"></script>       
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-tagsinput.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.countdown.min.js"></script>        
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/DateTimePicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/summernote.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validatr.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/autoNumeric.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jWaitingModal.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/i18n/defaults-es_ES.min.js"></script>

        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">ITM</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo base_url() ?>assets/images/logos_itm/icon_itm_recortado.png" /></span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- Notifications: style can be found in dropdown.less -->
                            <!--                            <li class="dropdown notifications-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-bell-o"></i>
                                                                <span class="label label-warning"><?php //echo ($this->session->userdata('ventas_pendientes')+$this->session->userdata('peticiones_pendientes')+$this->session->userdata('cotizaciones_pendientes'));  ?></span>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li class="header">Tienes <?php //echo ($this->session->userdata('ventas_pendientes')+$this->session->userdata('peticiones_pendientes')+$this->session->userdata('cotizaciones_pendientes'));  ?> notificaciones</li>
                                                                <li>
                                                                  
                                                                    <ul class="menu">
                                                                        <li>
                                                                            <a href="<?php // echo base_url() . 'ventamovil';  ?>">
                                                                                <i class="fa fa-shopping-cart text-aqua"></i> <?php //echo $this->session->userdata('ventas_pendientes');  ?> Ventas por enviar
                                                                            </a>
                                                                        </li>
                            
                            
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>-->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>assets/images/avatar_simple.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('nombre'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>assets/images/avatar_simple.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $this->session->userdata('nombre'); ?>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url(); ?>menu/cambiar_clave" class="btn btn-info btn-flat">Cambiar Clave</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>menu/logout" class="btn btn-danger btn-flat">Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>

                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar s">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets/images/avatar_simple.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $this->session->userdata('nombre'); ?></p>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <div id="side-bar-p">
                        <?php
                        // $this->load->library('../controllers/menu');
                        // $this->menu->sidebar();
                        ?>
                    </div>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">



                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('message'); ?></h5></div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5></div>
                    <?php } ?>
