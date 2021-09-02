<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Asociar doumentación legal</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="buscar_equipo" action="<?php echo base_url(); ?>equipos/buscar_equipos_documento_legal">
                    <div class="col-md-6">
                        <label for="equipo_id">Placa del equipo</label>
                        <input type="text" name="equipo_id" placeholder="Digite la identificación del equipo" class="form-control" id="equipo_id" required>
                    </div>
                    <div class="col-md-6">
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
                equipo_id: $("#equipo_id").val()
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
</script>

