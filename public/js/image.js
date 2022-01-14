$(document).ready(function(){

    $(document).on('click','.btn-modal',function(){     
        $('.image_modal').load($(this).data('href'),function(){
            $('.image_modal').modal('show');
        })   
    });


    $(document).on('submit', 'form#image_add_form', function(e) {
        e.preventDefault();
        $('form#image_add_form').validate();

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
                    $('div.image_modal').modal('hide');
                    toastr.success(result.msg);
                    window.location.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_image_button', function(){
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
                    contentType: false,
                    processData: false,
                    success: function(result){
                        if(result.success == true){
                            toastr.success(result.msg);
                            window.location.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
});