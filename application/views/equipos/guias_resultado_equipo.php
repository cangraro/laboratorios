<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <?php if ($respuesta) { ?>
            <form id="actualizar_archivo" action="<?php echo base_url(); ?>equipos/actualizar_guia">            
                <input type="text" name="id" style="display: none;" value='<?php echo $equipo->id; ?>' class="form-control" id="id">
                <input type="text" name="placa" style="display: none;" value='<?php echo $equipo->placa_inventario; ?>' class="form-control" id="placa">
                <div class="box box-danger color-palette-box" id="formulario_inicial">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i>Datos guias</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>                                
                                    <b class="text-info"><?php echo $equipo->descripcion; ?></b>
                                    <b class="text-info"><?php echo $equipo->placa_inventario; ?></b>
                                </h3>
                            </div>
                        </div>    
                        <div class="box box-danger color-palette-box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-file"></i>Datos Guía</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">                                    
                                    <?php $required_guia = (isset($equipo->ubicacion_guia) && $equipo->ubicacion_guia != "") ? "" : "required"; ?>
                                    <div class="col-md-12" id="file_div">                            
                                        <input type="file" name="file_guias" id="file_guias" data-placeholder="No file" accept ="application/pdf"  <?php echo $required_guia; ?> class="filestyle" >
                                    </div>
                                </div>
                                <?php if (isset($equipo->ubicacion_guia) && $equipo->ubicacion_guia != "") { ?>                                    
                                    <div class="table-responsive ">
                                        <table cellpadding="0" cellspacing="0" border="0" style="font-size:12px" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a class="text danger" align='center' href="<?php echo base_url() . $equipo->ubicacion_guia; ?>"  id="<?php echo $equipo->id . 'guia'; ?>" rel="btn_descargar_adjunto" target="_blank">Guía</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary form-control" name="submit"><span class="fa fa-upload" aria-hidden="true"></span> Subir archivo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </form>
        <?php } else { ?>
            <div class="alert alert-info" role="alert" align='center'>
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $('input[type=file]').on('change', prepareUpload);
    function prepareUpload(event)
    {
        $("#resultado").fadeOut("fast");
        var size = event.target.files[0].size / 1024 / 1024;
        if (size > 3) {
            $("#resultado").removeClass("alert-success").addClass("alert-danger");
            $("#resultado").html("La imagen pesa más de 3 Mb");
            $("#file_guias").val("");
            $("#resultado").fadeIn("fast");

        } else {
            $("#file_guias").prop('required', true);
            $("#imagen").empty();
            files = event.target.files;
        }
    }
    $("#actualizar_archivo").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Adjuntando guía...');
        var data = new FormData();
        if ($("#file_guias").val() != "") {
            $.each(files, function (key, value)
            {
                data.append(key, value);
            });
        }
        data.append('id', $("#id").val());
        data.append('placa', $("#placa").val());
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function (data) {
                $("#wm-modal").hideWmModal();
                $("#loader_ajax").fadeOut('fast', function () {                    
                    if (data.respuesta == true) {
                        $("#resultado").removeClass("alert-danger").addClass("alert-success");
                        $("#resultado_consulta").fadeOut('fast');
                    } else {
                        $("#resultado").removeClass("alert-success").addClass("alert-danger");

                    }
                    $("#resultado").html(data.mensaje);
                    $("#resultado").fadeIn("fast");
                });
            },
            error: function (data, textStatus)
            {                
                $("#wm-modal").hideWmModal();
                $("#loader_ajax").fadeOut('fast', function () {
                    $("#resultado").removeClass("alert-success").addClass("alert-danger");
                    $("#resultado_consulta").fadeOut('fast');
                    $("#wm-modal").hideWmModal();
                    $("#resultado").html('El documento no cumple con las reglas de documentos.');
                    $("#resultado").fadeIn("fast");
                });
            }
        });
        return false;
    });
    $("#btn_cancelar").on("click", function () {
        $("#resultado_consulta").fadeOut('fast');
        $("#resultado_consulta").empty();
    });
    $("#file_guias").filestyle({
        placeholder: "Cargue un archivo",
        buttonText: "Escoger guia",
        icon: false
    });
</script>