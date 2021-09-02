<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Creación selectores</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="guardar_selector" action="<?php echo base_url(); ?>administracion/crear_selector">
                    <div class="col-md-4">
                        <label for="tablas">Tablas</label>
                        <?php
                        echo form_dropdown('tablas', $tablas, '', 'class="form-control" id ="tablas" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="selector">Selector</label>
                        <input type="text" name="selector" placeholder="Digite el nombre del selector de la tabla" class="form-control" id="selector" required>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_grabar_selector">&nbsp;</label>
                        <button type="submit" id="btn_grabar_selector" class="form-control btn btn-success"><span class="fa fa-save"></span> Guardar selector</button>
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
            <h3 class="box-title"><i class="fa fa-pencil"></i>Desactivar selectores</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="actualizar_selector" action="<?php echo base_url(); ?>administracion/inactivar_selector">
                    <div class="col-md-4">
                        <label for="tablas2">Tablas</label>
                        <?php
                        echo form_dropdown('tablas2', $tablas, '', 'class="form-control" id ="tablas2" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="selector">Selector</label>
                        <?php
                        echo form_dropdown('selectores', $selectores, '', 'class="form-control" id ="selectores" required');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_inactivar_selector">&nbsp;</label>
                        <button type="submit" id="btn_inactivar_selector" class="form-control btn btn-success"><span class="fa fa-thumbs-down"></span> Inactivar selector</button>
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
        $('#guardar_selector').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado").fadeOut("fast");
            $("#wm-modal").showWmModal('Guardando selector...');
            var data = {
                tablas: $("#tablas").val(),
                selector: $("#selector").val()
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
                            $("#selector").val('');
                            $("#tablas").val('');
                            $("#tablas2").val('');
                            $("#tablas2").change();
                            $("#selectores").val('');
                            
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
        $('#actualizar_selector').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado_inactivar").fadeOut("fast");
            $("#wm-modal").showWmModal('Inactivando selector...');
            var data = {
                tablas: $("#tablas2").val(),
                selector: $("#selectores").val()
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
                            $("#selector").val('');
                            $("#tablas").val('');
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
    $("#tablas2").on('change', function () {
        $("#selectores").fadeOut('fast');
        $("#selectores").empty();
        var data = {
            tablas: $("#tablas2").val()
        };
        var url = "<?php echo base_url(); ?>administracion/obtener_selectores";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {               
                $("#selectores").fadeIn('fast', function () {                    
                    $("#selectores").html(data);                    
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

