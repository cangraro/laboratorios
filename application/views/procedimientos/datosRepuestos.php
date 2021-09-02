<?php
foreach ($datos as $k => $value) {
    print_r($datos);
    ?>

    <tr id="<?php echo 'repuesto_' . $k; ?>">
    <?php foreach ($value['datos_repuestos'] as $key => $val) { ?>
        <input type="hidden" name='<?php echo $key . $k; ?>' class='obtener' value="<?php echo (str_replace('"', "'", ((is_array($val)) ? implode(",", $val) : $val))); ?>">
    <?php } ?>
    <td><?php echo $value['descripcion_repuesto']; ?></td>
    <td><?php echo $value['cantidad']; ?></td>
    <td><button class="form-control btn btn-danger"onclick="eliminarRepuesto(<?php echo $k; ?>)"><i class="fa fa-trash"></i></button></td>
    </tr>                    
    <?php
} 