<div class="row">
    <?php
    $i = 0;
    foreach ($permisos as $p) {        
        if (!is_null($p->controller_id)) {
            $check = 'checked';
        } else {
            $check = '';
        }
        ?>
        <div class="col-md-3">
            <div class="checkbox checkbox-circle checkbox-danger">
                <input type="checkbox" name="chk-controller" class="flat-red" id="<?php echo $p->ctrl_id; ?>" value="<?php echo $p->ctrl_id; ?>"
                       <?php echo $check; ?>><label><?php echo $p->nombre; ?></label>
            </div>
        </div>
        <?php
        $i++;
        if ($i == 4) {
            $i = 0;
            ?>
        </div>
        <div class="row">
            <?php
        }
    }
    for ($j = $i; $j < 4; $j++) {
        ?>
        <div class="col-md-4">&nbsp;</div>
        <?php
    }
    ?>
</div>
<h2 class="text-center">Visibilidad de Menu
</h2>

<?php
foreach ($menu as $m) {
    ?>
    <h3 class="text-center"><?php echo $m->categoria_nombre; ?></h3>
    <div class="row">
        <?php
        $i = 0;
        foreach ($m->items as $item) {
            if (!is_null($item->id_permiso)) {
                $check = 'checked';
            } else {
                $check = '';
            }
            ?>
            <div class="col-md-3">
                <div class="checkbox checkbox-circle checkbox-danger">
                    <input type="checkbox" name="chk-menu-item" class="flat-red" id="<?php echo $item->menu_id; ?>" value="<?php echo $m->categoria; ?>" <?php echo $check; ?>><label><?php echo $item->nombre; ?></label>
                </div>
            </div>
            <?php
            $i++;
            if ($i == 4) {
                $i = 0;
                ?>
            </div>
            <div class="row">
                <?php
            }
        }
        for ($j = $i; $j < 4; $j++) {
            ?>
            <div class="col-md-4">&nbsp;</div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/controllers/permisos.js"></script>