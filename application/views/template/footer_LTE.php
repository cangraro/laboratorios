  </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <div id="wm-modal" class="wm-modal"></div>

<script>
    $(document).ready(function() {
        if("<?php echo $this->session->flashdata('message')?>" != ''){
           // alert("<?php echo $this->session->flashdata('message')?>");
        }
        $("#side-bar-p").load("<?php echo base_url(); ?>menu/sidebar")
        
       // $(document).foundation();
    });

</script>

</body>

<div class="footer">
    <div class="container">
        <p></p>
        <p class="text-center">Desarrollado por Carlos Granda y Jorge Hurtado</p>
    </div>
</div>

