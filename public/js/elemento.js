$(document).ready(function(){
    var parametros = [];
    var plagas = [];

    $(document).on('click','.galeria_button',function(){
        location.href = $(this).attr('data-href')
    });

    var elementos_table = $('#elementos_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "route('elemento.index')",
            data:{
                id:id_muestra
            }
        },
        columns : [
            {data: 'fecha',name:'fecha'},
            {data: 'lugar',name:'lugar'},
            {data: 'responsable', name: 'responsable'},
            {data: 'estado', name:'estado',searchable:false},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $.ajax({
            method: 'GET',
            url: '/admin/get-parametros',
            dataType: 'json',
            processData:false,
            contentType:false,
            success: function(result) {
                if(result){
                    parametros = [...result];
                }
            },
        });
        $.ajax({
            method: 'GET',
            url: '/admin/get-plagas',
            dataType: 'json',
            processData:false,
            contentType:false,
            success: function(result) {
                if(result){
                    plagas = [...result];
                }
            },
        });
        $('.elemento_modal').load($(this).data('href'),function(){
            $('.elemento_modal').modal('show');
        })
    });


    var i=0;
    let optionparametros = '';
    let optionPlagas = '';
    $(document).on('click','#add',function(){
        parametros.forEach(item => (
            optionparametros+='<option value='+item.id+'>'+item.nombre+'</option>'
        ))
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'" style="d-flex">'+
            '<td>'+
                '<select name="parametros[]" class="form-control name_list" required><option value="">-- Seleccione parametro --</option>'+optionparametros+'</select>'+
            '</td>'+
            '<td>'+
                '<input type="text" name="valorParametro[]" placeholder="Ingrese su valor" class="form-control name_list" required/>'+
            '</td>'+
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'
        );
        optionparametros='';
    })

    $(document).on('click','#add-plaga',function(){
        plagas.forEach(item => (
            optionPlagas+='<option value='+item.id+'>'+item.nombre+'</option>'
        ))
        i++;
        $('#dynamic_field_plaga').append('<tr id="rowplaga'+i+'" style="d-flex">'+
            '<td>'+
                '<select name="plagas[]" class="form-control name_list_plaga" required><option value="">-- Seleccione Plaga --</option>'+optionPlagas+'</select>'+
            '</td>'+
            '<td>'+
                '<input type="text" name="valorPlaga[]" placeholder="Ingrese su valor" class="form-control name_list" required/>'+
            '</td>'+
            '<td>'+
               '<select name="niveles[]" class="form-control">'+
                '<option value="0">Bajo</option>'+
                '<option value="1">Medio</option>'+
                '<option value="2">Alto</option>'+
               '</select>'+
            '</td>'+
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_plaga">X</button></td></tr>'
        );
        optionPlagas='';
    })

    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });

    $(document).on('click', '.btn_remove_plaga', function(){
        var button_id = $(this).attr("id");
        $('#rowplaga'+button_id+'').remove();
    });

    $(document).on('submit', 'form#elemento_form', function(e) {
        e.preventDefault();
        $('form#elemento_form').validate({
            rules: {
                name:{
                    required:true
                },
                description:{
                    required:true
                },
                price:{
                    required: true
                },
                category:{
                    required:false
                }
            }
        });

        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);

        var formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: formData,
            processData:false,
            contentType:false,
            success: function(result) {
                if (result.success == true) {
                    $('div.elemento_modal').modal('hide');
                    elementos_table.ajax.reload();
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_elemento_button', function(){
        Swal.fire({
            title: 'Estas seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!'
        }).then((willDelete) => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            toastr.success(result.msg);
                            elementos_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });


});
