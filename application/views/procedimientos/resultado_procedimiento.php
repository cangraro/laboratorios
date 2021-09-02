<div class="box box-danger">
    <div class="box-body">
        <div class="modal-header">            
            <h1 class="modal-title text-center text-primary" >
                Resumen procedimiento <b class="text-info" ><?php echo $id; ?></b>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h5 class="box-title">Datos procedimiento</h5></div>
                        <div class="box-body">     
                            <div class="col-md-6">
                                <h5><?php echo '<b>Número del procedimiento:</b> ' . $id; ?></h5>                                                  
                                <h5><?php echo '<b>Estado:</b> ' . $estado_procedimiento; ?></h5>                                                  
                                <h5><?php echo '<b>Usuario solicitante:</b> ' . $usuario_sol; ?></h5>
                                <h5><?php echo '<b>Tipo de procedimiento:</b> ' . $tipo_procedimiento; ?></h5>                                                  
                                <h5><?php echo '<b>Tipo de servicio:</b> ' . $tipo_servicio; ?></h5>                                    
                                <h5><?php echo '<b>Observación procedimiento:</b> ' . $observacion_p; ?></h5>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h5 class="box-title">Actualizar</h5></div>
                                    <div class="box-body">
                                        <form id="actualizar_fecha" action="<?php echo base_url(); ?>procedimientos/actualizar_fecha">   
                                            <input id="id_procedimiento" name="id_procedimiento" value='<?php echo $id; ?>' style="display: none;"/>
                                            <label for="fecha_programada">Fecha programada</label>
                                            <input id="fecha_programada" type="date" min="<?php echo date('Y-m-d'); ?>" name="fecha_programada" value='<?php echo ((isset($fecha_programada)) ? $fecha_programada : ""); ?>' class="form-control" placeholder="Digite la fecha del procedimiento" />
                                            <div id="dtBox"></div>
                                            <button type="submit" class="form-control btn btn-success"><span class="fa fa-save"></span> Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
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

    $('#actualizar_fecha').on('submit', function () {
        $("#loader_ajax").fadeIn();
        $("#wm-modal").showWmModal('Actualizando procedimiento...');
        var data = {
            id: $("#id_procedimiento").val(),
            fecha_programada: $("#fecha_programada").val()
        };
        $("#resultado_consulta").empty("fast");
        $("#resultado_consulta").fadeOut("fast");
        $("#resultado").fadeOut("fast");
        $("#resultado").empty();        
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#wm-modal").hideWmModal();
                $("#loader_ajax").fadeOut('fast', function () {
                    if (data.respuesta) {
                        $("#resultado").removeClass("alert-danger").addClass("alert-success");
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
</script>