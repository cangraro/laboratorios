<div id="menu_visitas" class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-info">
                <div class="panel-heading"><h2 class="text-center">Nuevo Usuario</h2></div>
                <div class="panel-body">
                    <div id="infoMessage"><?php echo $message; ?></div>

                    <?php echo form_open("auth/create_user"); ?>

                    <p>
                        <label for="usuario">Usuario:</label> <br />
                        <?php echo form_input($usuario); ?>
                    </p>

                    <p>
                        <label for="nombre">Nombres:</label> <br />
                        <?php echo form_input($first_name); ?>
                    </p>
                    <p>
                        <label for="nombre">Apellidos:</label> <br />
                        <?php echo form_input($last_name); ?>
                    </p>
                    <p>
                        <?php echo lang('create_user_email_label', 'email'); ?> <br />
                        <?php echo form_input($email); ?>
                    </p>

                  
                    <p>
                        <?php echo lang('create_user_password_label', 'password'); ?> <br />
                        <?php echo form_input($password); ?>
                    </p>

                    <p>
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
                        <?php echo form_input($password_confirm); ?>
                    </p>


                    <p><?php echo form_submit('submit', lang('create_user_submit_btn')); ?></p>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
