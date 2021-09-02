<container id="contenido">
    <div class="box box-danger color-palette-box" id="formulario_inicial">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i>Consulta Procedimientos</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="descargar_informes" action="<?php echo base_url(); ?>consultas/escogerDescarga">
                    <div class="col-md-4">
                        <label for="tipos_consultas">Tipo de descarga</label>
                        <?php
                        echo form_dropdown('tipos_consultas', $tipos_consultas, "", 'class="form-control" id ="tipos_consultas" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="btn_descargar">&nbsp;</label>
                        <button type="submit" id="btn_descargar" class="form-control btn btn-success"><span class="fa fa-download"></span> Descargar</button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>            
        </div>
    </div>
    <div>
        <div id='resultado_consulta' class="box box-danger" style="display: none;">

        </div>        
        <div id="loader_ajax_resumen" style="display: none;">
            <div style="text-align:center"><img src='<?php echo base_url(); ?>assets/images/loader_ajax.gif' align='middle' /></div>
        </div>        
    </div>
</container>
<script type="text/javascript">
    $(function () {
        $('#descargar_informes').on('submit', function () {
            $("#loader_ajax_resumen").fadeIn();
            $("#resultado_consulta").fadeOut("fast");
            $("#resultado").fadeOut("fast");
            $("#resultado").empty();
            $("#wm-modal").showWmModal('Generando informe...');
            var data = {
                tipoBusqueda: $("#tipos_consultas").val()
            };
            var url = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    $("#loader_ajax_resumen").fadeOut('fast', function () {
                        $("#resultado_consulta").html(data.vista);
                        $("#resultado_consulta").fadeIn("fast");
                        $("#wm-modal").hideWmModal();
                    });
                }
            });
            return false;
        });
    });
</script>