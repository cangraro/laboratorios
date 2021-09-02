
<div id="lista_procedimientos" class="box box-default">
    <div>
        <div class="col-md-12">
            <div class="alert alert-success" role="alert" id='resultado' style="display:none;" align='center'>

            </div>
        </div>
        <div id='resultado_consulta'>

        </div>
        <div id="loader_ajax" style="display: none;">
            <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_ajax.gif' align='middle' /></div>
        </div>
    </div>
    <div id="tabs" class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#mantenimiento_contenido" onclick="cargar_procedimientos(1)"><b class="text-info">Mantenimientos </b>
                    <div id="mantenimientos"></div>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="mantenimiento_contenido">
            </div>
        </div>
    </div>
</div>
<div class="modal md fade" id="contenedor_procedimiento" role="dialog">

</div>
<div id='contenedor_gestion_procedimiento' style="display:none;">

</div>


<script type="text/javascript">
    cargar_procedimientos(1);
    function cargar_procedimientos(estado) {
        $('#loader_ajax').fadeIn('fast');
        $('#descarga_contenido').empty();
        $('#descarga_div').fadeIn('fast');
        var url = '';
        switch (estado) {
            case 1:
                var bbody = $("#mantenimientos");
                var contenido = $("#mantenimiento_contenido");
                url = "<?php echo base_url(); ?>procedimientos/cargarProcedimientosLegalizacionMantenimientos";
                break;
            default:
                var bbody = $("#mantenimientos");
                var contenido = $("#mantenimiento_contenido");
                url = "<?php echo base_url(); ?>procedimientos/cargarProcedimientosLegalizacionMantenimientos";
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
    function ver_procedimiento(id, estado) {
        $("#wm-modal").showWmModal('Mostrando procedimiento...');
        var contenido = $("#contenedor_procedimiento");
        var loader = $("#loader_ajax");
        var url = "<?php echo base_url(); ?>procedimientos/obtenerProcedimiento";
        contenido.empty();
        loader.fadeIn('fast');
        var dato_enviar = {
            id: id,
            estado: estado
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
        var url = "<?php echo base_url(); ?>procedimientos/gestionarLegalizacionProcedimiento";
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
        $("#lista_procedimientos").fadeIn("fast");
    });
    function generar_documentos(id) {
        $("#wm-modal").showWmModal('Generando Documento...');
        var data = {
            id: id
        };        
        var url = "<?php echo base_url(); ?>procedimientos/generar_documentos";
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: url,
            data: data,
            success: function (data) {
                $("#wm-modal").hideWmModal();
                if (data.resultado == 1) {
                    downloadURI(data.url, data.nombre);
                }
            },
            statusCode: {
                500: function () {
                    $("#wm-modal").hideWmModal();
                },
                502: function () {
                    $("#wm-modal").hideWmModal();
                }
            }
        });
    }
    function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }

</script>