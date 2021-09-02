<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <?php
        if ($procedimientos->num_rows() > 0) {
            $procedimiento = $procedimientos->row();
            ?>            
            <div class="box box-danger color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pencil"></i>Datos equipo</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i>Datos generales</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Placa equipo:</b> ' . $procedimiento->placa_inventario; ?></h5>
                                    <h5><?php echo '<b>Tipo equipo:</b> ' . $procedimiento->tipo_equipo; ?></h5>
                                    <h5><?php echo '<b>Nombre equipo:</b> ' . $procedimiento->nombre_equipo; ?></h5>
                                    <h5><?php echo '<b>Marca:</b> ' . $procedimiento->marca; ?></h5>
                                    <h5><?php echo '<b>Modelo:</b> ' . $procedimiento->modelo; ?></h5>
                                    <h5><?php echo '<b>Número de serie:</b> ' . $procedimiento->no_serie; ?></h5>
                                    <h5><?php echo '<b>Sede:</b> ' . $procedimiento->sede; ?></h5>
                                    <h5><?php echo '<b>Ubicación:</b> ' . $procedimiento->ubicacion; ?></h5>
                                    <h5><?php echo '<b>Periodicidad mantenimiento:</b> ' . $procedimiento->periodicidad_mantenimiento; ?></h5>
                                    <h5><?php echo '<b>Rango:</b> ' . $procedimiento->rango; ?></h5>
                                    <h5><?php echo '<b>Fecha de compra:</b> ' . $procedimiento->fecha_compra; ?></h5>
                                    <?php
                                    $display = (isset($procedimiento->fecha_fin_garantia) && $procedimiento->fecha_fin_garantia != '') ? '' : 'display:none;';
                                    ?>                            
                                    <div id='garantia_fecha' style="<?php echo $display ?>">
                                        <h5><?php echo '<b>Fecha garantia:</b> ' . $procedimiento->fecha_fin_garantia; ?></h5> 
                                    </div>
                                    <h5><?php echo '<b>Observación:</b> ' . $procedimiento->observacion; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-cog"></i>Dimensiones</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Peso:</b> ' . $procedimiento->peso; ?> </h5>
                                    <h5><?php echo '<b>Largo:</b> ' . $procedimiento->largo; ?> </h5>
                                    <h5><?php echo '<b>Ancho:</b> ' . $procedimiento->ancho; ?> </h5>
                                    <h5><?php echo '<b>Alto:</b> ' . $procedimiento->alto; ?> </h5>                                    
                                </div>
                            </div>
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-lightbulb-o"></i>Energia</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Voltaje:</b> ' . $procedimiento->voltaje; ?> </h5>
                                    <h5><?php echo '<b>Corriente:</b> ' . $procedimiento->corriente; ?> </h5>
                                    <h5><?php echo '<b>Frecuencia:</b> ' . $procedimiento->frecuencia; ?> </h5>                                                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-danger color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pencil"></i>Datos Procedimiento</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5><?php echo '<b>Número del procedimiento:</b> ' . $procedimiento->id; ?></h5>                                                  
                            <h5><?php echo '<b>Tipo de procedimiento:</b> ' . $procedimiento->tipo_procedimiento; ?></h5>                                                  
                            <h5><?php echo '<b>Tipo de servicio:</b> ' . $procedimiento->tipo_servicio; ?></h5>                                
                            <h5><?php echo '<b>Fecha programada:</b> ' . $procedimiento->fecha_programada; ?></h5>              
                            <h5><?php echo '<b>Observación procedimiento:</b> ' . $procedimiento->observacion_p; ?></h5>                             
                            <h5><?php echo '<b>Usuario que gestionó:</b> ' . $procedimiento->usuario_ejec; ?></h5>  
                            <h5><?php echo '<b>Fecha gestión:</b> ' . $procedimiento->fecha_ejecucion; ?></h5>      
                            <h5><?php echo '<b>Observación Cierre:</b> ' . $procedimiento->observacion_cierre; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <form id='adjuntar_documento' action="<?php echo base_url(); ?>procedimientos/adjuntar_documento_procedimiento">
                <input type="text" name="id" style="display: none;" value='<?php echo $procedimiento->id; ?>' class="form-control" id="id">
                <div class="row">
                    <div class="col-md-12" id="file_div">                            
                        <input type="file" name="file_documento" id="file_documento" required data-placeholder="No file" accept =".pdf,.doc,.docx"  reuired class="filestyle" >
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
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $("#btn_cancelar").on("click", function () {
        $("#wm-modal").showWmModal('Cancelando procedimiento...');
        $("#loader_ajax").fadeIn("fast");
        $("#contenedor_gestion_procedimiento").fadeOut("fast");
        $("#contenedor_gestion_procedimiento").empty();
        cargar_procedimientos(1);
        $("#lista_procedimientos").fadeIn("fast");
        $("#wm-modal").hideWmModal();
    });
    $('input[type=file]').on('change', prepareUpload);
    function prepareUpload(event)
    {
        $("#resultado").fadeOut("fast");
        var size = event.target.files[0].size / 1024 / 1024;
        if (size > 3) {
            $("#resultado").removeClass("alert-success").addClass("alert-danger");
            $("#resultado").html("El archivo supera los 3 Mb");
            $("#file_documento").val("");
            $("#resultado").fadeIn("fast");

        } else {
            $("#file_documento").prop('required', true);
            $("#imagen").empty();
            files = event.target.files;
        }
    }
    $("#adjuntar_documento").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Adjuntando documento...');
        var data = new FormData();
        if ($("#file_documento").val() != "") {
            $.each(files, function (key, value)
            {
                data.append(key, value);
            });
        }
        data.append('id', $("#id").val());
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
                        $("#resultado_consulta").fadeOut('fast');
                    }
                    $("#wm-modal").hideWmModal();

                    $("#resultado").html(data.mensaje);
                    $("#resultado").fadeIn("fast");
                    $("#contenedor_gestion_procedimiento").fadeOut("fast");
                    $("#contenedor_gestion_procedimiento").empty();
                    cargar_procedimientos(1);
                    $("#lista_procedimientos").fadeIn("fast");
                    $("#wm-modal").hideWmModal();
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
    $("#file_documento").filestyle({
        placeholder: "Cargue un archivo",
        buttonText: "Escoger el archivo de legalización",
        icon: false
    });
</script>