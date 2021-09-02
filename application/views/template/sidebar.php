<ul class="sidebar-menu">
    <li class="header">MENU PRINCIPAL</li>
    <?php
    foreach ($categorias as $categoria) {
        ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-<?php echo $categoria->icon ?>"></i>
                <span><?php echo $categoria->nombre; ?></span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <?php
                foreach ($categoria->menus as $menu) {
                    ?>
                    <li><a href="<?php echo base_url() . $menu->url; ?>"><i class="fa fa-<?php echo $menu->icon; ?>"></i><?php echo $menu->nombre; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
    }
    ?>
    <li><a href="<?php echo base_url(); ?>menu/logout"><i class="fa fa-power-off text-aqua"></i> <span>Salir</span></a></li>
</ul>