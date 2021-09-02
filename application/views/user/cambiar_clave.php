<div class="container-fluid">
     <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo validation_errors(); ?></h5></div>
            <?php } ?>
     <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert"><h5 class="text-center"><?php echo $error; ?></h5></div>
            <?php } ?>
    
    
   
    <?php echo form_open('menu/cambiar_clave'); ?>
    <div class="row">

        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center">Cambio de Clave</h3></div>
                <div class="panel-body">
                    <p>
                        <label for="clave_ant">Clave Anterior</label>
                        <input class="form-control" type="password" name="clave_ant" value="<?php echo set_value('clave_ant'); ?>"  />
                    </p>
                    <p>
                        <label for="clave">Clave Nueva</label>
                        <input class="form-control" type="password" name="clave" value="<?php echo set_value('clave'); ?>"  />
                    </p>
                    <p>
                        <label for="repetir_clave">Confirmacion de Clave Nueva</label>
                        <input class="form-control" type="password" name="repetir_clave" value="<?php echo set_value('repetir_clave'); ?>"  />

                    </p>
                    <p>
                        <input class="form-control btn-success" type="submit" value="Cambiar" />
                    </p>

                </div>

            </div>
        </div>
        <div class="col-md-4">&nbsp;</div>

    </div>
    <?php echo form_close(); ?>
</div>