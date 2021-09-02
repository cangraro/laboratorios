$("input[name=chk-controller]").on('click',function(e){
    var data = {
        cid:$(this).val(),
        gid:$("#drop_grupos").val(),
        check:$(this).prop( "checked" )
    };
    console.log(data);
     var url = $("#baseurl").val()+"auth/cambiar_permiso_grupo";
                 $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: data,
                success: function (data) {
                    //console.log(data);
                    if(data.res==true){

                    }else{
                        e.preventDefault();
                    }
                   
                }
            });
   
});


$("input[name=chk-menu-item]").on('click',function(e){
    var data = {
        cid:$(this).val(),
        mid:$(this).attr('id'),
        gid:$("#drop_grupos").val(),
        check:$(this).prop( "checked" )
    };
    console.log(data);
     var url = $("#baseurl").val()+"auth/cambiar_permiso_menu";
                 $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: data,
                success: function (data) {
                    //console.log(data);
                    if(data.res==true){

                    }else{
                        e.preventDefault();
                    }
                   
                }
            });
   
});