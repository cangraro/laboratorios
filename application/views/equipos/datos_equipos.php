<?php if ($respuesta) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h5 class="box-title">Datos Equipos</h5></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h5 class="box-title">Datos Generales</h5></div>
                                <div class="box-body">       

                                    <h5><?php echo '<b>Placa equipo: </b>' . $equipo->placa_inventario; ?></h5>
                                    <h5><?php echo '<b>Tipo equipo: </b>' . $equipo->tipo_equipo; ?></h5>
                                    <h5><?php echo '<b>Nombre equipo: </b>' . $equipo->descripcion; ?></h5>
                                    <h5><?php echo '<b>Marca: </b>' . $equipo->marca; ?></h5>
                                    <h5><?php echo '<b>Modelo: </b>' . $equipo->modelo; ?></h5>
                                    <h5><?php echo '<b>No serie: </b>' . $equipo->no_serie; ?></h5>
                                    <h5><?php echo '<b>Sede: </b>' . $equipo->sede; ?></h5>
                                    <h5><?php echo '<b>Ubicación: </b>' . $equipo->ubicacion; ?></h5>
                                    <h5><?php echo '<b>Periodicidad mantenimiento(meses): </b>' . $equipo->periodicidad_mantenimiento; ?></h5>
                                    <h5><?php echo '<b>Rango: </b>' . $equipo->rangos_id; ?></h5>                                            
                                    <h5><?php echo '<b>Fecha compra: </b>' . $equipo->fecha_compra; ?></h5>                                
                                    <?php if ($equipo->ubicacion_guia != '') { ?>
                                        <h5><b>Guía: </b><a class="text danger" align='center' href="<?php echo base_url() . $equipo->ubicacion_guia; ?>"  id="<?php echo $equipo->id . 'guia'; ?>" rel="btn_descargar_adjunto" target="_blank">Guía rapida</a></h5>
                                        <?php
                                    }
                                    if($equipo->ubicacion_documentacion_legal != ''){ ?>                                        
                                        <h5><b>Documentación legal: </b><a class="text danger" align='center' href="<?php echo base_url() . $equipo->ubicacion_documentacion_legal; ?>"  id="<?php echo $equipo->id . 'guia'; ?>" rel="btn_descargar_adjunto" target="_blank">Documentación legal</a></h5>
                                    <?php }
                                    $display = (isset($equipo->fecha_fin_garantia) && $equipo->fecha_fin_garantia != '') ? '' : 'display:none;';
                                    ?>                            
                                    <div id='garantia_fecha' style="<?php echo $display ?>">
                                        <h5><?php echo '<b>Fecha garantia:</b> ' . $equipo->fecha_fin_garantia; ?></h5> 
                                    </div>
                                    <h5><?php echo '<b>Observacion: </b>' . $equipo->observacion; ?></h5>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">                    
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-cog"></i>Dimensiones</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Peso: </b>' . $equipo->peso; ?> </h5>
                                    <h5><?php echo '<b>Largo: </b>' . $equipo->largo; ?> </h5>
                                    <h5><?php echo '<b>Ancho: </b>' . $equipo->ancho; ?> </h5>
                                    <h5><?php echo '<b>Alto: </b>' . $equipo->alto; ?> </h5>
                                </div>
                            </div>
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-lightbulb-o"></i>Energia</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Voltaje: </b>' . $equipo->voltaje; ?></h5>
                                    <h5><?php echo '<b>Corriente: </b>' . $equipo->corriente; ?></h5>
                                    <h5><?php echo '<b>Frecuencia: </b>' . $equipo->frecuencia; ?></h5>                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">                    
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-address-card"></i>Datos proveedor</h3>
                                </div>
                                <div class="box-body">
                                    <h5><?php echo '<b>Número de documento: </b>' . $equipo->documento; ?></h5>
                                    <h5><?php echo '<b>Nombre cliente: </b>' . $equipo->nombre_cliente; ?></h5>
                                    <h5><?php echo '<b>Departamento: </b>' . $equipo->departamento; ?></h5>
                                    <h5><?php echo '<b>Municipio: </b>' . $equipo->ciudad; ?></h5>
                                    <h5><?php echo '<b>Dirección: </b>' . $equipo->direccion; ?></h5>
                                    <h5><?php echo '<b>Teléfono: </b>' . $equipo->telefono; ?></h5>
                                    <h5><?php echo '<b>Celular: </b>' . $equipo->celular; ?></h5>
                                    <h5><?php echo '<b>Email: </b>' . $equipo->email; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-danger color-palette-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-picture-o"></i>Fotografía</h3>
                                </div>
                                <div class="box-body" align="center">
                                    <img class="img-responsive img-rounded" src="<?php echo base_url() . $equipo->ubicacion_foto; ?>" width="200" height="60" id="<?php echo $equipo->placa_inventario; ?>" name="<?php echo $equipo->placa_inventario; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btn_documentos" onclick="generar_documentos('<?php echo $equipo->placa_inventario ?>')" class="form-control btn btn-success"><span class="fa fa-file"></span> Descargar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-info" role="alert" align='center'>
        <?php echo $mensaje; ?>
    </div>
    <?php
}