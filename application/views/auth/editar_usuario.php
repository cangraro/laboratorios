<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title text-center"><?php echo $user->username; ?></h3></div>
            <div class="box-body">

                <?php
                echo form_open('auth/edit_user', 'id="form_edit_user"');
                $style = "class='form-control'";
                ?>

                <p>
                    <label for="first_name">Nombres:</label> <br />
                    <?php echo form_input($first_name, 'first_name', $style); ?>
                </p>
                <p>
                    <label for="last_name">Apellidos:</label> <br />
                    <?php echo form_input($last_name, 'last_name', $style); ?>
                </p>
                <p>
                    <?php echo lang('edit_user_password_label', 'password'); ?> <br />
                    <?php echo form_password('password', '', $style); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
                    <?php echo form_password('password_confirm', '', $style); ?>
                </p>

                <?php if ($this->ion_auth->is_admin()): ?>

                    <h3>Grupos</h3>
                    <div class="btn-group" data-toggle="buttons">
                        <?php foreach ($groups as $group): ?>
                            <?php
                            $gID = $group['id'];
                            $checked = null;
                            $active = null;
                            $item = null;
                            foreach ($currentGroups as $grp) {
                                if ($gID == $grp->id) {
                                    $checked = 'checked';
                                    $active = 'active';
                                    break;
                                }
                            }
                            ?>
                            <label class="btn btn-default <?php echo $active; ?>">

                                <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>/>
                                <?php echo $group['name']; ?></label>

                        <?php endforeach ?>
                    </div>

                <?php endif ?>

                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>
                <p><?php echo form_submit('submit', 'Guardar', "class='btn btn-success'"); ?></p>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $("#form_edit_user").on('submit', function (e) {
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                async: 'False',
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: data,
                success: function (data) {
                    $("#mensaje_accion").html(data.mensaje);
                    $("#mensaje_accion").removeClass('hidden');
                    $("#mensaje_accion").addClass('fadeIn');
                    $("#dialog-message-editar_usuario").modal('hide');
                },
                statusCode: {
                    500: function () {
                        $("#consulta_contenido").fadeOut('fast', function () {
                            $("#consulta_contenido").html("<h1>Error Interno! si el problema persiste favor informar al administrador</h1>");
                            $("#consulta_contenido").fadeIn('fast');
                        });
                    },
                    502: function () {
                        $("#consulta_contenido").fadeOut('fast', function () {
                            $("#consulta_contenido").html("<h1>Error de conexion por favor intentar en unos segundos</h1>");
                            $("#consulta_contenido").fadeIn('fast');
                        });
                    }
                }
            });
            e.preventDefault();
            return false;
        });
    });
</script>
