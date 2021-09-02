<?php
if ($procedimientos->num_rows() > 0) {
    foreach ($procedimientos->result() as $procedimientos) {
        if ($procedimientos->estado != '2') {
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="no_pendiente" id="<?php echo $procedimientos->id; ?>">
                        <div class="row">
                            <div class="col-md-4">                                                      
                                <h5 class="text-info"><b>Número procedimiento: </b><?php echo $procedimientos->id; ?></h5>     
                                <h5 class="text-info"><b>Tipo de Procedimiento: </b><?php echo $procedimientos->tipo_procedimiento; ?></h5>                    
                                <h5 class="text-info"><b>Tipo de Equipo: </b><?php echo $procedimientos->tipo_equipo; ?></h5>                    
                                <h5 class="text-info"><b>Nombre Equipo: </b><?php echo $procedimientos->nombre_equipo; ?></h5>                    
                                <h5 class="text-info"><b>Fecha programada: </b><?php echo $procedimientos->fecha_programada; ?></h5>
                            </div>

                            <div class="col-md-4">                                                                                  
                                <?php if (!isset($gestion)) { ?>
                                    <h5 class="text-info">
                                        <div class="contador" data-countdown="<?php echo $procedimientos->fecha_programada; ?>" id="<?php echo 'procedimientos_' . $procedimientos->id; ?>">
                                        </div>
                                    </h5>
                                <?php } ?>
                            </div>
                            <div class="col-md-4" align="right">
                                <h5>
                                    <?php if (!isset($gestion)) { ?>
                                        <button class="btn btn-success" onclick="gestionar_procedimiento(<?php echo $procedimientos->id; ?>)" data-loading-text="Gestionando procedimiento"  name="<?php echo $procedimientos->id; ?>"><i class="fa fa-send"></i>Gestionar</button>
                                    <?php } ?>
                                    <?php if (isset($procedimientos->ruta_documento) && ($procedimientos->ruta_documento) != '') { ?>
                                        <a class=" btn btn-success" align="center" href="<?php echo base_url() . $procedimientos->ruta_documento; ?>" target="_blank">Formato de legalización</a>
                                    <?php } ?>
                                    <button class="btn btn-success" onclick="ver_procedimiento(<?php echo $procedimientos->id; ?>,<?php echo $procedimientos->estado; ?>)"  name="<?php echo $procedimientos->id; ?>"><i class="fa fa-eye"></i>Ver</button>                                    
                                </h5>                            
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($procedimientos->estado == '2') {
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="no_pendiente" id="<?php echo $procedimientos->id; ?>">
                        <div class="row">
                            <div class="col-md-4">                                                      
                                <h5 class="text-info"><b>Número procedimiento: </b><?php echo $procedimientos->id; ?></h5>                    
                                <h5 class="text-info"><b>Tipo de Procedimiento: </b><?php echo $procedimientos->tipo_procedimiento; ?></h5>                    
                                <h5 class="text-info"><b>Tipo de Equipo: </b><?php echo $procedimientos->tipo_equipo; ?></h5>                    
                                <h5 class="text-info"><b>Nombre Equipo: </b><?php echo $procedimientos->nombre_equipo; ?></h5>                    
                                <h5 class="text-info"><b>Fecha programada: </b><?php echo $procedimientos->fecha_programada; ?></h5>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4" align="right">
                                <h5>
                                    <?php if (!isset($bandera)) { ?>
                                        <button class="btn btn-success" onclick="generar_documentos(<?php echo $procedimientos->id; ?>)" data-loading-text="Generando documento"  name="<?php echo $procedimientos->id; ?>"><i class="fa fa-file"></i>Documento</button>
                                        <button class="btn btn-success" onclick="gestionar_procedimiento(<?php echo $procedimientos->id; ?>)" data-loading-text="Gestionando procedimiento"  name="<?php echo $procedimientos->id; ?>"><i class="fa fa-send"></i>Gestionar</button>
                                    <?php } ?>
                                    <?php if (isset($procedimientos->ruta_documento) && ($procedimientos->ruta_documento) != '') { ?>
                                        <a class=" btn btn-success" align="center" href="<?php echo base_url() . $procedimientos->ruta_documento; ?>" target="_blank">Formato de legalización</a>
                                    <?php } ?>
                                    <button class="btn btn-success" onclick="ver_procedimiento(<?php echo $procedimientos->id; ?>,<?php echo $procedimientos->estado; ?>)"  name="<?php echo $procedimientos->id; ?>"><i class="fa fa-eye"></i>Ver</button>                                    
                                </h5>                            
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} else {

    echo '<div class="">No hay procedimientos en este estado</div>';
}
?>
<script type="text/javascript">
    $('[data-countdown]').each(function () {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('Faltan %D Dias para terminar el ANS'));
            if (event['type'] == 'finish') {
                $(this).append("<h3 class='text-danger'>ANS Vencido</h3>");
            }

        });
    });
</script>