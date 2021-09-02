<div class="box-body">
    <?php if ($resultado == 1) { ?>

        <div class="col-md-12 col-lg-4 col-lg-offset-4" id="contenido_vista">

            <h2 class="text-center text-warning">Tu descarga esta lista!</h2>
            <a class="form-control btn btn-success" href="<?php echo $url_descarga; ?>"><span class="fa fa-save"></span> Descargar</a>
        </div>
        <?php
    } else {
        ?>
        <div class="col-md-12">
            <h4 class="text-center text-danger">No hay informacion para el mes seleccionado!</h4>
        </div>
    <?php } ?>
</div>