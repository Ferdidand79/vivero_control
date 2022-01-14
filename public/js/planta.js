$(document).ready(function(){
    var plantas_table = $('#plantas_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "plantas"
        },
        columns : [
            {data: 'nombre_comun',name:'nombre_comun'},
            {data: 'nombre_cientifico',name:'nombre_cientifico'},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $('.planta_modal').load($(this).data('href'),function(){
            $('.planta_modal').modal('show');
        })
    });

    $(document).on('submit', 'form#planta_form', function(e) {
        e.preventDefault();
        $('form#planta_form').validate({
            rules: {
                nombre_comun:{
                    required:true
                },
                nombre_cientifico:{
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
                    $('div.planta_modal').modal('hide');
                    plantas_table.ajax.reload();
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_planta_button', function(){
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
                            plantas_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });


});
