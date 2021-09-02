<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <form id="guardar_equipo" action="<?php echo base_url(); ?>equipos/guardar_equipos">            
            <input type="text" name="equipo_id" style="display: none;" value='<?php echo $equipo->placa_inventario; ?>' class="form-control fields" id="equipo_id" required>
            <div class="box box-danger color-palette-box">  
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pencil"></i>Datos genéricos</h3>
                </div>
                <div class="box-body">                    
                    <div class="row">
                        <?php $class = (isset($equipo->ubicacion_foto) && $equipo->ubicacion_foto != "") ? "col-md-6" : "col-md-12"; ?>
                        <?php $required = (isset($equipo->ubicacion_foto) && $equipo->ubicacion_foto != "") ? "" : "required"; ?>
                        <div class="<?php echo $class; ?>" id="file_div">                            
                            <input type="file" name="file" id="file_image" data-placeholder="No file" accept ="image/jpeg"  <?php echo $required; ?> class="filestyle" >
                        </div>
                        <?php if (isset($equipo->ubicacion_foto) && $equipo->ubicacion_foto != "") { ?>
                            <div id="imagen">
                                <div class="col-md-6" align="center">                            
                                    <img class="img-responsive img-rounded" src="<?php echo base_url() . $equipo->ubicacion_foto; ?>" width="200" height="60" id="<?php echo $equipo->placa_inventario; ?>" name="<?php echo $equipo->placa_inventario; ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (isset($equipo->ubicacion_foto) && $equipo->ubicacion_foto != "") { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="estado">Estado equipo</label>
                                <?php echo form_dropdown('estado', $estados, (isset($equipo->estado)) ? $equipo->estado : "", 'class="form-control fields" id ="estado" required'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="equipo_id">Placa equipo</label>
                            <input type="text" name="equipo_id" disabled value='<?php echo $equipo->placa_inventario; ?>' placeholder="Digite la identificación del equipo" class="form-control fields" id="equipo_id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion">Nombre del equipo</label>
                            <input type="text" name="descripcion" value='<?php echo ((isset($equipo->descripcion)) ? $equipo->descripcion : ""); ?>' placeholder="Digite el nombre del equipo" class="form-control fields" id="descripcion" required>
                        </div>            
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tipoEquipo">Tipo equipo</label>
                            <?php
                            echo form_dropdown('tipoEquipo', $tipoEquipo, (isset($equipo->id_tipos_equipos)) ? $equipo->id_tipos_equipos : "", 'class="form-control fields" id ="tipoEquipo" required ');
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?php
                            $checked = (isset($equipo->fecha_fin_garantia) && $equipo->fecha_fin_garantia != '') ? 'checked' : '';
                            $display = (isset($equipo->fecha_fin_garantia) && $equipo->fecha_fin_garantia != '') ? '' : 'display:none;';
                            ?>
                            <div class="checkbox checkbox-circle checkbox-danger">
                                <input type="checkbox" class="flat-info" name="chk_garantia" id="chk_garantia" <?php echo $checked ?>  >
                                <label for='chk_garantia'>
                                    <b>Tiene garantía?</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4" id='garantia_fecha' style="<?php echo $display ?>">
                            <label for="fecha_fin_garantia">Fecha fin garantía</label>
                            <input id="fecha_fin_garantia" type="date" name="fecha_fin_garantia" value='<?php echo ((isset($equipo->fecha_fin_garantia)) ? $equipo->fecha_fin_garantia : ""); ?>' class="form-control fields" placeholder="Digite la fecha de compra" />                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="marcas">Marca</label>
                            <?php
                            echo form_dropdown('marcas', $marcas, (isset($equipo->marcas_id)) ? $equipo->marcas_id : "", 'class="form-control fields" id ="marcas" required ');
                            ?>
                        </div>
                        <div class="col-md-6">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" value='<?php echo ((isset($equipo->modelo)) ? $equipo->modelo : ""); ?>' placeholder="Digite el modelo del equipo" class="form-control fields" id="modelo" required>
                        </div> 

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sede">Sede</label>
                            <?php
                            echo form_dropdown('sede', $sedes, (isset($equipo->sedes_id)) ? $equipo->sedes_id : "", 'class="form-control fields" id ="sede" required ');
                            ?>
                        </div>
                        <div class="col-md-6">
                            <label for="ubicaciones">Ubicacion</label>
                            <?php
                            if ($respuesta) {
                                echo form_dropdown('ubicaciones', $ubicaciones, (isset($equipo->ubicacion_id)) ? $equipo->ubicacion_id : "", 'class="form-control fields" id ="ubicaciones" required ');
                            } else {
                                echo form_dropdown('ubicaciones', $ubicacion, '', 'class="form-control fields" id ="ubicaciones" required ');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="no_serie">Número de serie</label>
                            <input type="text" name="no_serie" value='<?php echo ((isset($equipo->no_serie)) ? $equipo->no_serie : ""); ?>' placeholder="Digite el número de serie" class="form-control fields" id="no_serie" required>
                        </div>    
                        <div class="col-md-6">
                            <label for="periodicidad_mto">Periodicidad mantenimiento</label>
                            <input type="number" name="periodicidad_mto" value='<?php echo ((isset($equipo->periodicidad_mantenimiento)) ? $equipo->periodicidad_mantenimiento : ""); ?>' placeholder="Digite la periodicidad de mantenimiento (meses)" class="form-control fields" id="periodicidad_mto" required>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rangos">Rango</label>
                            <input type="rangos" name="rangos" value='<?php echo ((isset($equipo->rangos_id)) ? $equipo->rangos_id : ""); ?>' placeholder="Digite el rango" class="form-control fields" id="rangos" required>
                        </div> 
                        <div class="col-md-6">
                            <label for="fecha_compra">Fecha compra</label>
                            <input id="fecha_compra" type="date" name="fecha_compra" value='<?php echo ((isset($equipo->fecha_compra)) ? $equipo->fecha_compra : ""); ?>' class="form-control fields" placeholder="Digite la fecha de compra" required />
                            <div class="dtbox" id="dtbox"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="proveedores">Proveedores</label>
                            <?php echo form_dropdown('proveedores', $proveedores, (isset($equipo->id_proveedor)) ? $equipo->id_proveedor : "", 'class="form-control fields" id ="proveedores" required '); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="manuales">Tiene manuales?</label>
                            <?php echo form_dropdown('manuales', $manuales, (isset($equipo->id_manuales)) ? $equipo->id_manuales : "", 'class="form-control fields" id ="manuales" required'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="observacion">Observación</label>
                            <textarea id="observacion" class="form-control fields" maxlength="250" rows='2' name="observacion" placeholder="Digite una observación" required><?php echo ((isset($equipo->observacion)) ? $equipo->observacion : ""); ?></textarea> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-danger color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cog"></i>Dimensiones</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="peso">Peso</label>
                            <input type="text" name="peso" value='<?php echo ((isset($equipo->peso)) ? $equipo->peso : ""); ?>' placeholder="Digite el peso(kg)" class="form-control fields" id="peso" required>
                        </div> 
                        <div class="col-md-6">
                            <label for="largo">Largo</label>
                            <input type="text" name="largo" value='<?php echo ((isset($equipo->largo)) ? $equipo->largo : ""); ?>' placeholder="Digite el largo" class="form-control fields" id="largo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ancho">Ancho</label>
                            <input type="text" name="ancho" value='<?php echo ((isset($equipo->ancho)) ? $equipo->ancho : ""); ?>' placeholder="Digite el ancho" class="form-control fields" id="ancho" required>
                        </div>
                        <div class="col-md-6">
                            <label for="alto">Alto</label>
                            <input type="text" name="alto" value='<?php echo ((isset($equipo->alto)) ? $equipo->alto : ""); ?>' placeholder="Digite el alto" class="form-control fields" id="alto" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-danger color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-lightbulb-o"></i>Energia</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="voltaje">Voltaje</label>
                            <input type="text" name="voltaje" value='<?php echo ((isset($equipo->voltaje)) ? $equipo->voltaje : ""); ?>' placeholder="Digite el voltaje" class="form-control fields" id="voltaje" required>
                        </div> 
                        <div class="col-md-4">
                            <label for="corriente">Corriente</label>
                            <input type="text" name="corriente" value='<?php echo ((isset($equipo->corriente)) ? $equipo->corriente : ""); ?>' placeholder="Digite la corriente" class="form-control fields" id="corriente" required>
                        </div>
                        <div class="col-md-4">
                            <label for="frecuencia">Frecuencia</label>
                            <input type="text" name="frecuencia" value='<?php echo ((isset($equipo->frecuencia)) ? $equipo->frecuencia : ""); ?>' placeholder="Digite la frecuencia" class="form-control fields" id="frecuencia" required>
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
    </div>
</div>
<script type="text/javascript">    
    
    $("#dtbox").DateTimePicker({
        shortDayNames: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        fullDayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        shortMonthNames: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        fullMonthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        dateFormat: "yyyy-MM-dd",
        setButtonContent: "Aceptar",
        clearButtonContent: "Borrar",
        titleContentDate: "Fecha"
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
            $("#file_div").removeClass("col-md-6").addClass("col-md-12");
            $("#file_image").prop('required', true);
            $("#imagen").empty();
            files = event.target.files;
        }
    }
    $("#guardar_equipo").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Guardando equipo...');
        var data = new FormData();
        if ($("#file_image").val() != "") {
            $.each(files, function (key, value)
            {
                data.append(key, value);
            });
        }
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

    $("#sede").on('change', function () {
        $("#ubicaciones").fadeOut('fast');
        $("#ubicaciones").empty();
        var data = {
            sedes: $("#sede").val()
        };
        var url = "<?php echo base_url(); ?>equipos/obtener_ubicaciones";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#ubicaciones").fadeIn('fast', function () {
                    $("#ubicaciones").html(data);
                });
            }
        });
    });
    $('#chk_garantia').on('change', function () {
        $("#fecha_fin_garantia").val('');
        if ($(this).prop('checked'))
        {
            $("#fecha_fin_garantia").prop('required', true);
            $("#garantia_fecha").fadeIn('fast');
        } else
        {
            $("#fecha_fin_garantia").prop('required', false);
            $("#garantia_fecha").fadeOut('fast');
        }
    });
    $("#file_image").filestyle({
        placeholder: "Cargue un archivo",
        buttonText: "Escoger una foto",
        icon: false
    });     

</script>