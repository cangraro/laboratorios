<!DOCTYPE HTML>
<html>
    <head>
        <title>Portal Gestion Equipos Laboratorios ITM</title>
        <meta charset="UTF-8" />        
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>favicon.ico' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    </head>
    <body>        
        <div class="container">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('message'); ?></h5></div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-success" role="alert"><h5 class="text-center"><?php echo $this->session->flashdata('error'); ?></h5></div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12 col-lg-4 col-lg-offset-4">
                    <h1 class="text-center login-title">Identificate para  continuar a la aplicación de laboratorios</h1>
                    <div class="account-wall">
                        <img class="profile-img" src="<?php echo base_url() ?>assets/images/logo_une_120.png" alt="">
                        <?php echo form_open('menu/login', "class= 'form-signin'"); ?>
                        <input type="text" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
                        <input type="password" name="clave" class="form-control" placeholder="Clave" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                        <label class="checkbox pull-left">
                        </label>                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer id="main">
        </footer>
    </body>
</html>