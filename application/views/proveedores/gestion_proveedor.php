<div class="panel panel-primary">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <form id="guardar_proveedor" action="<?php echo base_url(); ?>proveedores/guardar_proveedor">            
            <input type="text" name="documento" style="display: none;" value='<?php echo $proveedor->documento; ?>' class="fields" id="documento" required>
            <input type="text" name="tipo_documento" style="display: none;" value='<?php echo $proveedor->tipo_documento; ?>' class="fields" id="tipo_documento" required>
            <div class="box box-danger color-palette-box">  
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pencil"></i>Datos genéricos</h3>
                </div>
                <div class="box-body">
                    <div class="row">                        
                        <div class="col-md-6">
                            <label for="documento_id">Número del documento</label>
                            <input type="text" name="documento_id" disabled value='<?php echo $proveedor->documento; ?>' placeholder="Digite la identificación del proveedor" class="form-control fields" id="documento_id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_proveedor">Nombre del proveedor</label>
                            <input type="text" name="nombre_proveedor" value='<?php echo ((isset($proveedor->nombre_cliente)) ? $proveedor->nombre_cliente : ""); ?>' placeholder="Digite el nombre del proveedor" class="form-control fields" id="nombre_proveedor" required>
                        </div>            
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="departamento">Departamento</label>
                            <?php
                            echo form_dropdown('departamento', $departamentos, (isset($proveedor->id_departamento)) ? $proveedor->id_departamento : "", 'class="form-control fields" id ="departamento" required ');
                            ?>
                        </div>
                        <div class="col-md-6">
                            <label for="ciudades">Ciudades</label>
                            <?php
                            if ($respuesta) {
                                echo form_dropdown('ciudades', $ciudades, (isset($proveedor->ciudad_id)) ? $proveedor->ciudad_id : "", 'class="form-control fields" id ="ciudades" required ');
                            } else {
                                echo form_dropdown('ciudades', $ciudad, '', 'class="form-control fields" id ="ciudades" required ');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" value='<?php echo ((isset($proveedor->direccion)) ? $proveedor->direccion : ""); ?>' placeholder="Digite la dirección" class="form-control fields" id="direccion" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" value='<?php echo ((isset($proveedor->email)) ? $proveedor->email : ""); ?>' placeholder="Digite el correo electrónico" class="form-control fields" id="email" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="number" maxlength="7" name="telefono" value='<?php echo ((isset($proveedor->telefono)) ? $proveedor->telefono : ""); ?>' placeholder="Digite el número de telefono" class="form-control fields" id="telefono" required>
                        </div> 
                        <div class="col-md-6">
                            <label for="celular">Celular</label>
                            <input type="number" maxlength="10" pattern="[3]{1}[0-9]{9,}" name="celular" value='<?php echo ((isset($proveedor->celular)) ? $proveedor->celular : ""); ?>' placeholder="Digite el número de celular" class="form-control fields" id="celular" required>
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
    $("#guardar_proveedor").on("submit", function () {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Guardando proveedor...');
        var data=$(this).serialize();        
        var url = $(this).attr('action');
        console.log(data);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
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

    $("#departamento").on('change', function () {
        $("#ciudades").fadeOut('fast');
        $("#ciudades").empty();
        var data = {
            departamento: $("#departamento").val()
        };
        var url = "<?php echo base_url(); ?>proveedores/obtener_ciudades";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#ciudades").fadeIn('fast', function () {
                    $("#ciudades").html(data);
                });
            }
        });
    });

</script>