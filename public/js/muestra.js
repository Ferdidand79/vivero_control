$(document).ready(function(){
    var muestras_table = $('#muestras_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "muestras"
        },
        columns : [
            {data: 'planta_nombre',name:'planta_nombre',searchable:false},
            {data: 'ubicacion',name:'ubicacion'},
            {data: 'estado',name:'estado'},
            {data: 'fecha',name:'fecha'},
            {data: 'responsable',name:'responsable'},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $('.muestra_modal').load($(this).data('href'),function(){
            $('.muestra_modal').modal('show');
        })
    });

    $(document).on('click','.btn-detalle-muestra',function(){
        location.href = $(this).attr('data-href')
    });

    $(document).on('submit', 'form#muestra_form', function(e) {
        e.preventDefault();
        $('form#muestra_form').validate({
            rules: {
                planta:{
                    required:true
                },
                ubicacion:{
                    required:true
                },
                estado:{
                    required:true
                },
                responsable:{
                    required:true
                },
                fecha:{
                    required:true
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
                    $('div.muestra_modal').modal('hide');
                    muestras_table.ajax.reload();
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_muestra_button', function(){
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
                            muestras_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });


});
