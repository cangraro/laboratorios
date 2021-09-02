<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Consulta Equipos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="buscar_equipo" action="<?php echo base_url(); ?>equipos/buscar_equipos">
                    <div class="col-md-4">
                        <label for="tipoBusqueda">Tipo de busqueda</label>
                        <?php
                        echo form_dropdown('tipoBusqueda', $tipoBusqueda, "", 'class="form-control" id ="tipoBusqueda" required ');
                        ?>
                    </div>
                    <div class="col-md-4" id='consulta_sede' style="display:none;">
                        <label for="sedes">Sedes</label>
                        <?php
                        echo form_dropdown('sedes', $sedes, "", 'class="form-control" id ="sedes"');
                        ?>
                    </div>
                    <div class="col-md-4" id='consulta_equipo'>
                        <label for="equipo_id">Placa del equipo</label>
                        <input type="text" name="equipo_id" placeholder="Digite la identificación del equipo" class="form-control" id="equipo_id" required>
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
            <div class="alert alert-success" role="alert" id='resultado' style="display:none;" align='center'>

            </div>
        </div>
        <div id="loader_ajax" style="display: none;">
            <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_ajax.gif' align='middle' /></div>
        </div>
    </div>
    <div class="modal md fade" id="modal_equipo" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="box box-danger">
                    <div class="box-body">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h1 class="modal-title text-center text-primary" >
                                Resumen equipo
                            </h1>
                        </div>
                        <div class="modal-body" id="contenedor_equipo">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</container>
<script type="text/javascript">
    $(function () {
        $('#buscar_equipo').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado_consulta").fadeOut("fast");
            $("#resultado").fadeOut("fast");
            $("#resultado").empty();
            $("#wm-modal").showWmModal('Buscando equipo...');
            var data = {
                equipo_id: $("#equipo_id").val(),
                tipoBusqueda: $("#tipoBusqueda").val(),
                sedes: $("#sedes").val(),
                bandera: '1'
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
                        $("#resultado_consulta").html(data.vista_equipo);
                        $("#resultado_consulta").fadeIn("fast");
                    });
                }
            });
            return false;
        });
    });
    $('#tipoBusqueda').on('change', function () {
        $("#wm-modal").showWmModal('Cambiando consulta...');
        if ($(this).val() === '1') {
            $('#consulta_equipo').fadeIn('fast');
            $('#consulta_sede').fadeOut('fast');
            $("#equipo_id").prop('required', true);
            $("#sedes").prop('required', false);
        } else {
            $('#consulta_equipo').fadeOut('fast');
            $('#consulta_sede').fadeIn('fast');
            $("#equipo_id").prop('required', false);
            $("#sedes").prop('required', true);
        }
        $("#wm-modal").hideWmModal();
    });
    function ver_equipo(id_equipo) {
        $("#loader_ajax").fadeIn();
        $("#resultado").fadeOut("fast");
        $("#wm-modal").showWmModal('Buscando equipo...');
        var data = {
            equipo_id: id_equipo,
            bandera: '1'
        };
        var url = "<?php echo base_url(); ?>equipos/buscar_equipos";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
            success: function (data) {                
                $("#loader_ajax").fadeOut('fast', function () {
                    $("#wm-modal").hideWmModal();
                    $("#contenedor_equipo").html(data.vista_equipo);
                    $("#modal_equipo").modal("show");
                });
            }
        });
        return false;
    }    
    function generar_documentos(id) {
        $("#wm-modal").showWmModal('Generando Documento...');
        var data = {
            id: id
        };        
        var url = "<?php echo base_url(); ?>equipos/generar_documentos";
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

