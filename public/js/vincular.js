$(document).ready(function(){
    var vincular_table = $('#vincular_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "vincular"
        },
        columns : [
            {data: 'planta_nombre',name:'planta_nombre',searchable:false},
            {data: 'parametro_nombre',name:'parametro_nombre',searchable:false},
            {data: 'valor_min',name:'valor_min'},
            {data: 'valor_max',name:'valor_max'},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $('.vincular_modal').load($(this).data('href'),function(){
            $('.vincular_modal').modal('show');
        })
    });

    $(document).on('submit', 'form#vincular_form', function(e) {
        e.preventDefault();
        $('form#vincular_form').validate({
            rules: {
                planta:{
                    required:true
                },
                parametro:{
                    required:true
                },
                valor_min:{
                    required:true
                },
                valor_max:{
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
                    $('div.vincular_modal').modal('hide');
                    vincular_table.ajax.reload();
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_vincular_button', function(){
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
                            vincular_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });


});
