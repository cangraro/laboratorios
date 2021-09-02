<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Consulta Procedimientos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="buscar_procedimiento" action="<?php echo base_url(); ?>procedimientos/buscar_procedimientos_por_tipo">
                    <div class="col-md-4">
                        <label for="tipoBusqueda">Tipo de busqueda</label>
                        <?php
                        echo form_dropdown('tipoBusqueda', $tipoBusqueda, "", 'class="form-control" id ="tipoBusqueda" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="id" id='criterio_busqueda'>Criterio</label>
                        <input type="text" name="id" placeholder="Digite el numero de placa" class="form-control" id="id" required>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_buscar">&nbsp;</label>
                        <button type="submit" id="btn_buscar" class="form-control btn btn-success"><span class="fa fa-search"></span> Buscar</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>            
        </div>
    </div>
    <div>
        <div id='resultado_consulta'>

        </div>
        <div class="col-md-12">
            <div class="alert alert-error" role="alert" id='resultado' style="display:none;" align='center'>

            </div>
        </div>
        <div id="loader_ajax_resumen" style="display: none;">
            <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_ajax.gif' align='middle' /></div>
        </div>
        <div class="modal md fade" id="contenedor_procedimiento" role="dialog">

        </div>
    </div>
</container>
<script type="text/javascript">
    $(function () {
        $('#buscar_procedimiento').on('submit', function () {
            $("#loader_ajax_resumen").fadeIn();
            $("#resultado_consulta").fadeOut("fast");
            $("#resultado").fadeOut("fast");
            $("#resultado").empty();
            $("#wm-modal").showWmModal('Buscando procedimientos...');
            var data = {
                id: $("#id").val(),
                tipoBusqueda: $("#tipoBusqueda").val()
            };
            var url = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    $("#loader_ajax_resumen").fadeOut('fast', function () {
                        if (data.respuesta) {
                            if ($("#tipoBusqueda").val() == '1') {
                                $("#resultado_consulta").html(data.vista);
                                $("#resultado_consulta").fadeIn("fast");
                            } else {
                                $("#contenedor_procedimiento").html(data.vista);
                                $("#contenedor_procedimiento").modal('show');
                            }

                        } else {
                            $("#resultado").html(data.mensaje);
                            $("#resultado").fadeIn("fast");
                        }
                        $("#wm-modal").hideWmModal();
                    });
                }
            });
            return false;
        });
    });

    $('#tipoBusqueda').on('change', function () {
        if ($(this).val() === '1') {
            $('#criterio_busqueda').html('Placa inventario');
            $("#id").attr('placeholder', 'Digite el número de la placa');
        } else {
            $('#criterio_busqueda').html('Número de procedimiento');
            $("#id").attr('placeholder', 'Digite el número del procedimientos');
        }
    });
</script>