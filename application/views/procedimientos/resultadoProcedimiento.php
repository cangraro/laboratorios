<div id="terminar_procedimiento">
    <div class="panel panel-default" >
        <div class="panel-heading">Resultado procedimiento</div>
        <div class="row">
            <div class="panel-body">
                <div class="col-md-12">
                    <h4 class="text-center"><strong><?php echo $mensaje; ?></strong></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-4">
                <button class="form-control btn btn-success" id="btn_aceptar">Aceptar</button>
            </div>
            <div class="col-md-4">&nbsp;</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#btn_aceptar").on('click', function () {
        $("#loader_ajax").fadeIn('fast');
        $("#wm-modal").showWmModal('Cargando procedimientos...');
        $("#loader_ajax").fadeIn("fast");
        $("#contenedor_gestion_procedimiento").fadeOut("fast");
        $("#contenedor_gestion_procedimiento").empty();
        cargar_procedimientos(1);
        cargar_procedimientos(2);
        $("#lista_procedimientos").fadeIn("fast");
        $("#wm-modal").hideWmModal();
    });
</script>