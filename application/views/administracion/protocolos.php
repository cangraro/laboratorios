<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Administración de protocolos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="guardar_protocolo" action="<?php echo base_url(); ?>administracion/crear_protocolo">
                    <div class="col-md-4">
                        <label for="tipos_equipos">Tipos de equipos</label>
                        <?php
                        echo form_dropdown('tipos_equipos', $tipos_equipos, '', 'class="form-control" id ="tipos_equipos" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="protocolo">Protocolo</label>
                        <input type="text" name="protocolo" placeholder="Digite el nombre del protocolo" class="form-control" id="protocolo" required>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_grabar_selector">&nbsp;</label>
                        <button type="submit" id="btn_grabar_protocolo" class="form-control btn btn-success"><span class="fa fa-save"></span> Guardar protocolo</button>
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
            <h3 class="box-title"><i class="fa fa-pencil"></i>Inactivar protocolos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="actualizar_protocolo" action="<?php echo base_url(); ?>administracion/inactivar_protocolo">
                    <div class="col-md-4">
                        <label for="tipo_equipo2">Tipo equipo</label>
                        <?php
                        echo form_dropdown('tipo_equipo2', $tipos_equipos, '', 'class="form-control" id ="tipo_equipo2" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="protocolos2">Protocolos</label>
                        <?php
                        echo form_dropdown('protocolos2', $protocolos, '', 'class="form-control" id ="protocolos2" required');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_inactivar_selector">&nbsp;</label>
                        <button type="submit" id="btn_inactivar_selector" class="form-control btn btn-success"><span class="fa fa-thumbs-down"></span> Inactivar protocolo</button>
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
        $('#guardar_protocolo').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado").fadeOut("fast");
            $("#wm-modal").showWmModal('Guardando sede...');
            var data = {
                tipo_equipo: $("#tipos_equipos").val(),
                protocolo: $("#protocolo").val()
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
                            $("#tipo_equipo2").val('');
                            $("#tipo_equipo2").change();
                            $("#protocolo2").val('');
                            $("#tipo_equipo").val('');
                            $("#protocolo").val('');
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
        $('#actualizar_protocolo').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado_inactivar").fadeOut("fast");
            $("#wm-modal").showWmModal('Inactivando sede...');
            var data = {
                tipo_equipo: $("#tipo_equipo2").val(),
                protocolo: $("#protocolos2").val()
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
                            $("#tipo_equipo2").val('');
                            $("#tipo_equipo2").change();
                            $("#protocolo2").val('');
                            $("#tipo_equipo").val('');
                            $("#protocolo").val('');
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
    $("#tipo_equipo2").on('change', function () {
        $("#protocolos2").fadeOut('fast');
        $("#protocolos2").empty();
        var data = {
            tipo_equipo: $("#tipo_equipo2").val()
        };
        var url = "<?php echo base_url(); ?>administracion/obtener_protocolos";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {
                $("#protocolos2").fadeIn('fast', function () {
                    $("#protocolos2").html(data);
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

