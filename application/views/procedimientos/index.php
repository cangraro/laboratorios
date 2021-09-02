<div id="lista_procedimientos" class="box box-default">
    <div id="tabs" class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#procedimientos_programados_contenido" onclick="cargar_procedimientos(1)"><b class="text-info">Programados </b>
                    <div id="procedimientos_programados"></div>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#procedimientos_solicitados_contenido" onclick="cargar_procedimientos(2)"><b class="text-info">Solicitados</b>
                    <div id="procedimientos_solicitados"></div>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="procedimientos_programados_contenido">
            </div>
            <div class="tab-pane fade" id="procedimientos_solicitados_contenido">
            </div>
        </div>
    </div>
</div>
<div class="modal md fade" id="contenedor_procedimiento" role="dialog">

</div>
<div id='contenedor_gestion_procedimiento' style="display:none;">

</div>
<div id="loader_ajax" style="display: none;">
    <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_new.gif'align='middle' /></div>
</div>
<script type="text/javascript">
    cargar_procedimientos(1);
    cargar_procedimientos(2);
    function cargar_procedimientos(estado) {
        $('#loader_ajax').fadeIn('fast');
        $('#descarga_contenido').empty();
        $('#descarga_div').fadeIn('fast');
        var url = '';
        switch (estado) {
            case 1:
                var bbody = $("#procedimientos_programados");
                var contenido = $("#procedimientos_programados_contenido");
                url = "<?php echo base_url(); ?>procedimientos/cargarProcedimientosProgramados";
                break;
            case 2:
                var bbody = $("#procedimientos_solicitados");
                var contenido = $("#procedimientos_solicitados_contenido");
                url = "<?php echo base_url(); ?>procedimientos/cargarProcedimientosSolicitados";
                break;
            default:
                var bbody = $("#procedimientos_programados");
                var contenido = $("#procedimientos_programados_contenido");
                url = "<?php echo base_url(); ?>procedimientos/cargarProcedimientosProgramados";
                break;

        }
        contenido.html('');
        bbody.html('');
        bbody.append('<div class="overlay" id="loader_lte"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        var loader = bbody.find("#loader_lte");
        loader.fadeIn('fast');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url,
            //data: dato_enviar,
            success: function (data) {
                loader.fadeOut('fast', function () {
                    bbody.html(data.cantidad);
                    contenido.html(data.html);
                    $('#loader_ajax').fadeOut('fast');
                });
            },
            statusCode: {
                500: function () {
                    contenido.html(
                            "<p class='text-center text-danger'>Error Interno! si el problema persiste favor informar al administrador!!</p>"
                            );
                },
                502: function () {
                    contenido.html("<h1>Error de conexion por favor intentar en unos segundos</h1>");
                },
                404: function () {
                    $("#loader_ajax").fadeOut('fast', function () {
                        $("#" + dato_enviar["id"] + "").remove();
                        $("#contenido_venta").fadeIn('fast', function () {
                            $("#mensaje_ocupado").fadeIn(500).delay(2000).fadeOut(500,
                                    function () {
                                    });

                        });
                    });
                }
            }
        });
    }
    function ver_procedimiento(id,estado) {
        $("#wm-modal").showWmModal('Mostrando procedimiento...');
        var contenido = $("#contenedor_procedimiento");
        var loader = $("#loader_ajax");
        var url = "<?php echo base_url(); ?>procedimientos/obtenerProcedimiento";
        contenido.empty();
        loader.fadeIn('fast');
        var dato_enviar = {
            id: id,
            estado:estado
        };
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url,
            data: dato_enviar,
            success: function (data) {
                loader.fadeOut('fast', function () {
                    $("#wm-modal").hideWmModal();
                    contenido.html(data.html);
                    contenido.modal('show');
                });
            }
        });
    }
    function gestionar_procedimiento(id) {
        $("#wm-modal").showWmModal('Mostrando procedimiento...');
        var contenido = $("#contenedor_gestion_procedimiento");
        $("#lista_procedimientos").fadeOut("fast");
        var loader = $("#loader_ajax");
        var url = "<?php echo base_url(); ?>procedimientos/gestionarProcedimiento";
        contenido.empty();
        loader.fadeIn('fast');
        var dato_enviar = {
            id: id
        };
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url,
            data: dato_enviar,
            success: function (data) {
                loader.fadeOut('fast', function () {
                    $("#wm-modal").hideWmModal();
                    contenido.html(data.vista_gestion);
                    contenido.fadeIn("fast");
                });
            }
        });
    }
    $("#btn_cancelar").on("click", function () {
        $("#loader_ajax").fadeIn("fast");
        $("#contenedor_gestion_procedimiento").fadeOut("fast");
        $("#contenedor_gestion_procedimiento").emtpy();
        cargar_procedimientos(1);
        cargar_procedimientos(2);
        console.log("hol");
        $("#lista_procedimientos").fadeIn("fast");
    });

</script>