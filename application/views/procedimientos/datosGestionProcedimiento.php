<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <?php
        if ($procedimientos->num_rows() > 0 && $actividades->num_rows() > 0) {
            $procedimiento = $procedimientos->row();
            $actividad = $actividades->result_object();
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-danger color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cog"></i>Repuestos</h3>
                </div>
                <div class="box-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <form id='adicionar_repuesto'>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="descripcion_repuesto">Descripción repuesto</label>
                                        <input type="text" form="adicionar_repuesto" placeholder="Digite el nombre del respuesto" required maxlength="50" name="descripcion_repuesto" class="form-control repuesto" id="descripcion_repuesto">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="descripcion_repuesto">Cantidad</label>
                                        <input type="number" form="adicionar_repuesto" placeholder="Digite la cantidad de repuestos" required min="1" name="cantidad" class="form-control solo-numero repuesto" id="cantidad">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="btn_buscar">&nbsp;</label>
                                        <button type="submit" id="btn_adicionar_repuesto" class="form-control btn btn-success"><span class="fa fa-plus"></span> Adicionar</button>                                    
                                    </div>
                                </div>
                            </form>
                            <div id="repuestos_car" class="table-responsive" style="display: none;overflow-x:auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="registros_repuestos">

                                    </tbody>
                                </table> 

                            </div>
                            <div id="loader_ajax_car" style="display: none;">
                                <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_new.gif'align='middle' /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="guardar_resultado_procedimiento" action="<?php echo base_url(); ?>procedimientos/guardar_resultado_procedimiento" >            
                <input type="text" name="procedimiento_id" class='obtener' style="display: none;" value='<?php echo $procedimiento->id; ?>' id="procedimiento_id">
                <input type="text" name="cantidadActividades" class='obtener' style="display: none;" value='<?php echo $actividades->num_rows(); ?>' id="cantidadActividades">
                <div class="box box-danger color-palette-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i>Actividades</h3>
                    </div>
                    <div class="box-body">
                        <div align="center"><h4><b>C:cumple / NC: no cumple / NA: no aplica</b></h4></div>
                        <?php
                        $i = 0;
                        foreach ($actividad as $key => $value) {
                            ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <label><?php echo $value->descripcion; ?></label>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    echo form_dropdown('resultados' . $i, $resultados, "", 'class="form-control resultados obtener" id ="resultados' . $i . '" required ');
                                    ?>
                                    <input type="text" name="actividad<?php echo $i; ?>" style="display: none;" class="resultados obtener" value='<?php echo $value->id; ?>' id="actividad<?php echo $i; ?>">
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="observacion">Observación de cierre</label>
                                <textarea id="observacion" class="form-control resultados obtener" maxlength="250" name="observacion" placeholder="Digite alguna observación adicional" required></textarea> 
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

        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $(".solo-numero").keyup(function (e) {
        if ((e.keyCode === 36 || e.keyCode === 16)) {
            return;
        } else {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        }
    });
    $(".solo-numero").on("keypress", function (evt) {
        if (evt.type === "keypress")
            return !!String.fromCharCode(evt.which).match(/[0-9]|\,/);
        this.value = this.value.replace(/[0-9]|\,/, "");

        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]|\,/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    });
    $("#btn_cancelar").on("click", function () {
        $("#wm-modal").showWmModal('Cancelando procedimiento...');
        $("#loader_ajax").fadeIn("fast");
        $("#contenedor_gestion_procedimiento").fadeOut("fast");
        $("#contenedor_gestion_procedimiento").empty();
        cargar_procedimientos(1);
        cargar_procedimientos(2);
        $("#lista_procedimientos").fadeIn("fast");
        $("#wm-modal").hideWmModal();
    });

    $("#guardar_resultado_procedimiento").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#wm-modal").showWmModal('Guardando resultado procedimiento...');
        $("#contenedor_gestion_procedimiento").fadeOut('fast');
        //var data = $(this).serialize();
        var data = {};
        $('.obtener').each(function () {
            data[this.name] = this.value;
        });
        data['cont'] = cont;
        var url = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#loader_ajax").fadeOut('fast', function () {
                    $("#contenedor_gestion_procedimiento").html(data.vista);
                    $("#contenedor_gestion_procedimiento").fadeIn("fast");
                    $("#wm-modal").hideWmModal();
                });
            }

        });
        return false;
    });
    var cont = 0;
    $('#adicionar_repuesto').on('submit', function () {
        event.preventDefault();
        if (validarCamposEspacios()) {
            return false;
        }
        cont++;
        $("#loader_ajax_car").fadeIn('fast');
        $("#repuestos_car").fadeOut('fast');
        var data = {};
        $('.repuesto').each(function () {
            data[this.name] = this.value;
        });
        data['cont'] = cont;
        var url = "<?php echo base_url(); ?>procedimientos/agregar_repuesto";
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url,
            data: data,
            success: function (data) {
                $("#loader_ajax_car").fadeOut('fast', function () {
                    $("#registros_repuestos").append(data.vista);
                    $("#repuestos_car").fadeIn('fast');
                    limpiarCampos();
                });
            }
        });
    });
    function validarCamposEspacios() {
        var bool = false;
        $('.validarespacios').each(function () {
            if (this.value.trim() == '') {
                this.value = '';
                bool = true;
            }
        });
        return bool;
    }
    function limpiarCampos() {
        $("#descripcion_repuesto").val('');
        $("#cantidad").val('');
    }
    function eliminarRepuesto(id) {
        event.preventDefault();
        $("#repuesto_" + id).remove();
    }

</script>