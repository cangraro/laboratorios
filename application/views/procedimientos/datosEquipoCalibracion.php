<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <?php if ($respuesta) { ?>
            <form id="guardar_calibracion" action="<?php echo base_url(); ?>procedimientos/guardar_calibracion">            
                <input type="text" name="id" style="display: none;" value='<?php echo $equipo->id; ?>' class="form-control fields" id="id">
                <div class="box box-danger color-palette-box" id="formulario_inicial">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i>Datos Calibración</h3>
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
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tipo_servicio">Tipo servicio</label>
                                <?php
                                echo form_dropdown('tipo_servicio', $tipo_servicios, "", 'class="form-control fields" id ="tipo_servicio" required ');
                                ?>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-6">
                                <label for="observacion">Observación</label>
                                <textarea id="observacion" class="form-control fields" maxlength="250" name="observacion" placeholder="Digite una descripción del problema" required></textarea> 
                            </div>
                            <div class="col-md-6" id="file_div"> 
                                <label for="file">&nbsp;</label>
                                <input type="file" name="file" id="file_archivo" data-placeholder="No file" accept =".doc,.docx,.pdf"  required class="filestyle" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="btn_buscar">&nbsp;</label>
                        <button type="submit" id="btn_guardar" class="form-control btn btn-success"><span class="fa fa-save"></span> Guardar</button>
                    </div>
                    <div class="col-md-6">
                        <label for="btn_cancelar">&nbsp;</label>
                        <button type="button" id="btn_cancelar" class="form-control btn btn-success"><span class="fa fa-times"></span> Cancelar</button>
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
    $("#dtBox").DateTimePicker({
        shortDayNames: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        fullDayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        shortMonthNames: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        fullMonthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        dateFormat: "yyyy-MM-dd",
        setButtonContent: "Aceptar",
        clearButtonContent: "Borrar",
        titleContentDate: "Fecha de compra",
        minDate: "<?php echo date('Y-m-d'); ?> "
    });
    $('input[type=file]').on('change', prepareUpload);
    function prepareUpload(event)
    {
        $("#resultado").fadeOut("fast");
        var size = event.target.files[0].size / 1024 / 1024;
        if (size > 3) {
            $("#resultado").removeClass("alert-success").addClass("alert-danger");
            $("#resultado").html("La imagen pesa más de 3 Mb");
            $("#file_image").val("");
            $("#resultado").fadeIn("fast");

        } else {
            files = event.target.files;
        }
    }
    $("#guardar_calibracion").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Guardando procedimiento...');
        var data = new FormData();
        $.each(files, function (key, value)
        {
            data.append(key, value);
        });
        $(".fields").each(function () {
            data.append(this.name, this.value);
        });
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
            }
        });
        return false;
    });

    $("#btn_cancelar").on("click", function () {
        $("#resultado_consulta").fadeOut('fast');
        $("#resultado_consulta").empty();
    });
    $("#file_archivo").filestyle({
        placeholder: "Cargue un archivo pdf,doc,docx",
        buttonText: "Escoger formato",
        icon: false
    });
</script>