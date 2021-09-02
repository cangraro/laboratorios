<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Creación de sedes</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="guardar_ubicacion" action="<?php echo base_url(); ?>administracion/crear_sedes">
                    <div class="col-md-4">
                        <label for="sede">Sede</label>
                        <?php
                        echo form_dropdown('sede', $sedes, '', 'class="form-control" id ="sede" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="ubicacion">Ubicacion</label>
                        <input type="text" name="ubicacion" placeholder="Digite el nombre de la ubicación" class="form-control" id="ubicacion" required>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_grabar_selector">&nbsp;</label>
                        <button type="submit" id="btn_grabar_ubicacion" class="form-control btn btn-success"><span class="fa fa-save"></span> Guardar Ubicación</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert" id='resultado' style="display:none;" align='center'>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-danger color-palette-box" id="formulario_inactivacion">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Inactivar ubicaciones</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="actualizar_ubicacion" action="<?php echo base_url(); ?>administracion/inactivar_sede">
                    <div class="col-md-4">
                        <label for="sedes2">Sedes</label>
                        <?php
                        echo form_dropdown('sedes2', $sedes, '', 'class="form-control" id ="sedes2" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="ubicacion2">Ubicaciones</label>
                        <?php
                        echo form_dropdown('ubicacion2', $ubicaciones, '', 'class="form-control" id ="ubicacion2" required');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_inactivar_selector">&nbsp;</label>
                        <button type="submit" id="btn_inactivar_selector" class="form-control btn btn-success"><span class="fa fa-thumbs-down"></span> Inactivar ubicación</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert" id='resultado_inactivar' style="display:none;" align='center'>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader_ajax" style="display: none;">
        <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_ajax.gif' align='middle' /></div>
    </div>
</container>
<script type="text/javascript">
    $(function () {
        $('#guardar_ubicacion').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado").fadeOut("fast");
            $("#wm-modal").showWmModal('Guardando sede...');
            var data = {
                sede: $("#sede").val(),
                ubicacion: $("#ubicacion").val()
            };
            var url = $(this).attr('action');
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
                            $("#sedes2").val('');
                            $("#sedes2").change();  
                            $("#ubicacion2").val('');
                            $("#sede").val('');
                            $("#ubicacion").val('');
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
        $('#actualizar_ubicacion').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado_inactivar").fadeOut("fast");
            $("#wm-modal").showWmModal('Inactivando sede...');
            var data = {
                sede: $("#sedes2").val(),
                ubicacion: $("#ubicacion2").val()
            };
            var url = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    $("#wm-modal").hideWmModal();
                    $("#loader_ajax").fadeOut('fast', function () {
                        if (data.respuesta == true) {
                            $("#resultado_inactivar").removeClass("alert-danger").addClass("alert-success");
                            $("#sedes2").val('');
                            $("#sedes2").change();                            
                            $("#ubicacion2").val('');
                            $("#sede").val('');
                            $("#ubicacion").val('');
                        } else {

                            $("#resultado_inactivar").removeClass("alert-success").addClass("alert-danger");
                        }
                        $("#resultado_inactivar").html(data.mensaje);
                        $("#resultado_inactivar").fadeIn("fast");
                    });
                }
            });
            return false;
        });
    });
    $("#sedes2").on('change', function () {
        $("#ubicacion2").fadeOut('fast');
        $("#ubicacion2").empty();
        var data = {
            sede: $("#sedes2").val()
        };
        var url = "<?php echo base_url(); ?>administracion/obtener_ubicaciones";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {               
                $("#ubicacion2").fadeIn('fast', function () {                    
                    $("#ubicacion2").html(data);                    
                });
            }
        });
    });    
    $(".form-control").on('change', function () {
        $("#resultado").fadeOut("fast");
        $("#resultado").empty();
        $("#resultado_inactivar").fadeOut("fast");
        $("#resultado_inactivar").empty();
    });
</script>

