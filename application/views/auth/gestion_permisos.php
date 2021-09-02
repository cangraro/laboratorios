<input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>" />
<div class="row">
    <div class="col-md-12">
        <label for="drop_grupos">Grupos</label>
        <?php 
            echo form_dropdown('drop_grupos',$grupos,'','class="form-control" id="drop_grupos"');
        ?>  
    </div>
</div>
<div id="ctn-prm"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#drop_grupos").on('click',function(){
                var data = {
                    id:$(this).val()
                };
                var url = "<?php echo base_url(); ?>auth/load_group_permisions";
                 $.ajax({
                type: 'POST',
                dataType: 'html',
                url: url,
                data: data,
                success: function (data) {
                    //console.log(data);
                    $("#ctn-prm").html(data);
                }
            });
        });

    });

</script>