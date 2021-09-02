<div class="box box-danger color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i>Equipos</h3>
    </div>
    <div class="box-body">


        <div class="table-responsive ">
            <table id="tabla_equipos" cellpadding="0" cellspacing="0" border="0" style="font-size:12px" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Tipo equipo</th>
                        <th>Ubicación</th>
                        <th>Nombre equipo</th>                
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipos as $equipo) { ?>
                        <tr>
                            <td><?php echo $equipo->placa_inventario; ?></td>
                            <td><?php echo $equipo->tipo_equipo; ?></td>
                            <td><?php echo $equipo->ubicacion; ?></td>
                            <td><?php echo $equipo->descripcion; ?></td>                    
                            <td>                                                        
                                <button class="form-control btn btn-success" onclick="ver_equipo('<?php echo $equipo->placa_inventario; ?>')"><i class="fa fa-eye"></i>Ver</button>                                    
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
            var table = $('#tabla_equipos').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
                "sInfo": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando desde 0 hasta 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
            "sUrl": "",
        "oPaginate": {
        "sFirst": "Primero",
                "sPrevious": "Anterior",
    "sNext": "Siguiente",
    "sLast": "Último"
            }

        }
    });
    table.order([0, 'desc']).draw();
            $('#tabla_equipos thead th').each(function () {
        var title = $(this).text();
    $(this).html('<input size="15px" type="text" placeholder="' + title + '" />');

    });
    table.columns().eq(0).each(function (colIdx) {
        $('input', table.column(colIdx).header()).on('keyup change', function () {
            table.column(colIdx).search(this.value).draw();
        });
    });
</script>