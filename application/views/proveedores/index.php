<container id="contenido">
    <div class="box box-danger color-palette-box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-o"></i>Proveedores</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form id="buscar_proveedor" action="<?php echo base_url(); ?>proveedores/buscar_proveedor">
                    <div class="col-md-4">
                        <label for="tipos_documentos">Tipo equipo</label>
                        <?php
                        echo form_dropdown('tipos_documentos', $tipos_documentos, "", 'class="form-control fields" id ="tipos_documentos" required ');
                        ?>
                    </div>
                    <div class="col-md-4">
                        <label for="documento_id">Documento proveedor</label>
                        <input type="text" name="documento_id" placeholder="Escoja un Tipo de Documento" class="form-control" id="documento_id" required>
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
        $('#buscar_proveedor').on('submit', function () {
            $("#loader_ajax").fadeIn();
            $("#resultado_consulta").fadeOut("fast");
            $("#resultado").fadeOut("fast");
            $("#resultado").empty();
            $("#wm-modal").showWmModal('Buscando proveedor...');
            var data = {
                tipos_documentos: $("#tipos_documentos").val(),
                documento_id: $("#documento_id").val()
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
                        $("#resultado_consulta").html(data.vista_proveedor);
                        $("#resultado_consulta").fadeIn("fast");
                    });
                }
            });
            return false;
        });
    });
    $('#tipos_documentos').change(function () {
        switch ($(this).val())
        {
            case '1':
                $("#documento_id").attr('placeholder', 'Digite NIT 9 Digitos');
                $("#documento_id").attr('maxlength', '9');
                break;
            case '2':
                $("#documento_id").attr('placeholder', 'Digite la Cedula');
                $("#documento_id").attr('maxlength', '10');
                break;
            case '3':
                $("#documento_id").attr('placeholder', 'Digite CV sin Digito de Verificacion');
                $("#documento_id").attr('maxlength', '10');
                break;
            default:
                $("#documento").attr('placeholder', 'Escoja un Tipo de Documento');
        }


    });
</script>