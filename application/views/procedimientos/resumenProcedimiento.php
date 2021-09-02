<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h1 class="modal-title text-center text-primary" >
                Resumen procedimiento <b class="text-info" ><?php echo $id; ?></b>
            </h1>
            <div class="modal-body" id="resumen_oportunidad">                
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h5 class="box-title">Datos Equipos</h5></div>
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="box box-danger">
                                        <div class="box-header with-border">
                                            <h5 class="box-title">Datos Generales</h5></div>
                                        <div class="box-body">
                                            <h5><?php echo '<b>Placa equipo: </b>' . $placa_inventario; ?></h5>
                                            <h5><?php echo '<b>Tipo equipo: </b>' . $tipo_equipo; ?></h5>
                                            <h5><?php echo '<b>Nombre equipo: </b>' . $nombre_equipo; ?></h5>
                                            <h5><?php echo '<b>Marca: </b>' . $marca; ?></h5>
                                            <h5><?php echo '<b>Modelo: </b>' . $modelo; ?></h5>
                                            <h5><?php echo '<b>No serie: </b>' . $no_serie; ?></h5>
                                            <h5><?php echo '<b>Sede: </b>' . $sede; ?></h5>
                                            <h5><?php echo '<b>Ubicación: </b>' . $ubicacion; ?></h5>
                                            <h5><?php echo '<b>Periodicidad mantenimiento(meses): </b>' . $periodicidad_mantenimiento; ?></h5>
                                            <h5><?php echo '<b>Rango: </b>' . $rango; ?></h5>                                            
                                            <h5><?php echo '<b>Fecha compra: </b>' . $fecha_compra; ?></h5>
                                            <?php
                                            $display = (isset($fecha_fin_garantia) && $fecha_fin_garantia != '') ? '' : 'display:none;';
                                            ?>                            
                                            <div id='garantia_fecha' style="<?php echo $display ?>">
                                                <h5><?php echo '<b>Fecha garantia:</b> ' . $fecha_fin_garantia; ?></h5> 
                                            </div>
                                            <h5><?php echo '<b>Observacion: </b>' . $observacion; ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box box-danger color-palette-box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-cog"></i>Dimensiones</h3>
                                        </div>
                                        <div class="box-body">
                                            <h5><?php echo '<b>Peso: </b>' . $peso; ?> </h5>
                                            <h5><?php echo '<b>Largo: </b>' . $largo; ?> </h5>
                                            <h5><?php echo '<b>Ancho: </b>' . $ancho; ?> </h5>
                                            <h5><?php echo '<b>Alto: </b>' . $alto; ?> </h5>
                                        </div>
                                    </div>
                                    <div class="box box-danger color-palette-box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-lightbulb-o"></i>Energia</h3>
                                        </div>
                                        <div class="box-body">
                                            <h5><?php echo '<b>Voltaje: </b>' . $voltaje; ?></h5>
                                            <h5><?php echo '<b>Corriente: </b>' . $corriente; ?></h5>
                                            <h5><?php echo '<b>Frecuencia: </b>' . $frecuencia; ?></h5>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h5 class="box-title">Datos procedimiento</h5></div>
                            <div class="box-body">                            
                                <h5><?php echo '<b>Número del procedimiento:</b> ' . $id; ?></h5>                                                  
                                <h5><?php echo '<b>Estado:</b> ' . $estado_procedimiento; ?></h5>                                                  
                                <h5><?php echo '<b>Usuario solicitante:</b> ' . $usuario_sol; ?></h5>
                                <?php if ($estado == "2") { ?>
                                    <h5><?php echo '<b>Usuario que ejecutó:</b> ' . $usuario_ejec; ?></h5> 
                                <?php } ?>
                                <h5><?php echo '<b>Tipo de procedimiento:</b> ' . $tipo_procedimiento; ?></h5>                                                  
                                <h5><?php echo '<b>Tipo de servicio:</b> ' . $tipo_servicio; ?></h5>                                
                                <h5><?php echo '<b>Fecha programada:</b> ' . $fecha_programada; ?></h5>              
                                <h5><?php echo '<b>Observación procedimiento:</b> ' . $observacion_p; ?></h5> 
                                <?php if ($ruta_documento != '') { ?>
                                    <h5><b>Formato adjunto: </b><a class="text danger" align='center' href="<?php echo base_url() . $ruta_documento; ?>"  id="<?php echo $id . 'formato'; ?>" rel="btn_descargar_adjunto" target="_blank">Formato de legalización</a></h5>
                                <?php } ?>  
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($actividades->num_rows() > 0) {
                    $actividades_obj = $actividades->result_object();
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h5 class="box-title">Actividades realizadas</h5></div>
                                <div class="box-body">
                                    <div id="accesos_car" class="table-responsive" style="overflow-x:auto;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td colspan='2' align='center'><h5><b>C:cumple / NC: no cumple / NA: no aplica</b></h5></td>
                                                </tr>
                                                <tr>
                                                    <th>Actividad</th>
                                                    <th>Resultado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($actividades_obj as $value) { ?>
                                                    <tr>
                                                        <td><h5><?php echo $value->actividad . ': '; ?></h5></td>
                                                        <td><h5><b><?php echo $value->resultado; ?></b></h5></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if ($repuestos->num_rows() > 0) {
                    $repuestos_obj = $repuestos->result_object();
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h5 class="box-title">Repuestos</h5></div>
                                <div class="box-body">
                                    <div id="accesos_car" class="table-responsive" style="overflow-x:auto;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Descripción repuesto</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($repuestos_obj as $value) { ?>
                                                    <tr>
                                                        <td><h5><?php echo $value->descripcion_repuesto . ': '; ?></h5></td>
                                                        <td><h5><b><?php echo $value->cantidad; ?></b></h5></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>