
<div id="menu_visitas" class="container-fluid">
    <div class="row">
        <div class="col-md-12" >
            <div class="callout callout-info hidden animated" id="mensaje_accion"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Usuarios</h3></div>
                <div class="box-body">
                    <div class="table-responsive ">
                        <table id="tabla_users" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th>Login</th>
                                    <th><?php echo lang('index_fname_th'); ?></th>

                                    <th><?php echo lang('index_email_th'); ?></th>
                                    <th><?php echo lang('index_groups_th'); ?></th>
                                    <th><?php echo lang('index_status_th'); ?></th>
                                    <th><?php echo lang('index_action_th'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user->username; ?></td>
                                        <td><?php echo $user->first_name.' '.$user->last_name; ?></td>

                                        <td><?php echo $user->email; ?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group): ?>
                                                <?php echo anchor("auth/edit_group/" . $group->id, $group->name); ?><br />
                                            <?php endforeach ?>
                                        </td>
                                        <td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></td>
                                        <td><?php echo "<button class='btn' onClick='editar_usuario($user->id)'>Editar</button>"; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table></div>
                </div>
            </div>
        </div>
    </div>

    <p style="color:#00377B;"><?php echo anchor('auth/create_user', lang('index_create_user_link')) ?> | <?php echo anchor('auth/create_group', lang('index_create_group_link')) ?></p>
    <div class="row">
        <div class="col-md-12">
            <div id="loader_ajax_contacto" style="display: none;">
                <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_new.gif' align='middle'></div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="respuesta">

            </div>
        </div>
    </div>

</div>

<div id="dialog-message-editar_usuario" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-tittle">Editar Usuario</h3>

            </div>

            <div class="modal-body" id="contenido_usuario">

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#tabla_users').dataTable();
        $("a[rel=sync]").on('click', function () {
            $("#loader_ajax_contacto").fadeIn('fast');
            $("#respuesta").fadeOut('fast');
            // $("#dialog-message-contacto").modal('hide');
            //var datastring = $(this).serialize();
            var url = $(this).attr('href');
            ////console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                success: function (data) {
                    ////console.log(data);
                    // $("#mensaje_modal").html('<h3>' + data['mensaje'] + '</h3>');

                    var respuesta = "<h4 class='text-center'>Usuarios Nuevos: " + data['activos'] + "</h4><h4 class='text-center'>Usuarios Inactivados: " + data['inactivos'] + "</h4><h4 class='text-center'>Usuarios Actualizados: " + data['actualizados'] + "</h4>";

                    //$("#mensaje_modal").html('Empresa actualizada correctamente');
                    $("#respuesta").html(respuesta);

                    $("#loader_ajax_contacto").fadeOut('fast');
                    $("#respuesta").fadeIn('fast');

                    // ////console.log(data);
                    //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                    // do what ever you want with the server response
                }
            });
            return false;
        });
    });
    function editar_usuario(id) {
        data = {'usuario': id};
        url = "<?php echo base_url(); ?>auth/editar_usuario_view";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: data,
            success: function (data) {
                $("#contenido_usuario").html(data.html);
                $("#dialog-message-editar_usuario").modal('show');
                // ////console.log(data);
                //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                // do what ever you want with the server response
            }
        });
        return false;
    }






</script>
