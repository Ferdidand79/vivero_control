$(document).ready(function(){
    var parametros_table = $('#parametros_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "parametros"
        },
        columns : [
            {data: 'nombre',name:'nombre'},
            {data: 'descripcion',name:'descripcion'},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $('.parametro_modal').load($(this).data('href'),function(){
            $('.parametro_modal').modal('show');
        })
    });

    $(document).on('submit', 'form#parametro_form', function(e) {
        e.preventDefault();
        $('form#parametro_form').validate({
            rules: {
                name:{
                    required:true
                },
                description:{
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
                    $('div.parametro_modal').modal('hide');
                    parametros_table.ajax.reload();
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_parametro_button', function(){
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
                            parametros_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });


});
