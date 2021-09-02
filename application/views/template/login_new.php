<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Equipos laboratorio</title>        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login/style.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
    </head>
    <body>
        <div class="top-content">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('message'); ?></h5></div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5></div>
            <?php } ?>
            
                <div class="container">
                    <div class="row">                        
                        <div class="col-md-12">
                            <h1 class="text-center login-title">Mantenimiento de Equipo Biomédico</h1>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div align="center">
                                        <img class="profile-img" height="180" width="300" src="<?php echo base_url() ?>assets/images/logo_itm.png" alt="">
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="<?php echo base_url(); ?>menu/login" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Usuario</label>
                                        <input type="text" name="usuario" placeholder="Usuario..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Clave</label>
                                        <input type="password" name="clave" placeholder="Clave..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn ">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            
        </div>        
    </body>
</html>
