$(document).ready(function(){
    $(document).on('submit','form#user_edit_profile_form',function(e){
        e.preventDefault();
        $('form#user_edit_profile_form').validate({
            rules: {
                name:{
                    required:true
                },
                email:{
                    required:true
                },
                phone:{
                    maxlength:8
                },
                address:{
                    required:false
                },
                business_name:{
                    required:false
                }
            }
        });

        $(this)
        .find('button[type="submit"]')
        .attr('disabled', true);

        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            method: 'PUT',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    toastr.success(result.msg);
                    $('form#user_edit_profile_form')
                    .find('button[type="submit"]')
                    .removeAttr('disabled');
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });


    $(document).on('submit', 'form#user_edit_password_form', function(e) {
        e.preventDefault();
        $('form#user_edit_password_form').validate({
            rules: {
                current_password: {
                    required: true,
                    minlength: 5,
                },
                new_password: {
                    required: true,
                    minlength: 5,
                },
                confirm_password: {
                    equalTo: '#new_password',
                },
            },
        });

        $(this)
        .find('button[type="submit"]')
        .attr('disabled', true);

        var data = $(this).serialize();
        console.log(data);

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('form#user_edit_password_form')
                    .find('button[type="submit"]')
                    .removeAttr('disabled');
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });



    var user_table = $('#user_table').DataTable({
        processing: false,
        serverSide: false,
        "ajax":{
            "url" : "user"
        },
        columns : [
            {data: 'name',name:'name'},
            {data: 'email',name:'email'},
            {data: 'phone', name:'phone'},
            {data: 'type', name: 'type'},
            {data: 'action',name:'action',orderable:false,searchable:false}
        ]
    });

    $(document).on('click','.btn-modal',function(){
        $('.user_modal').load($(this).data('href'),function(){
            $('.user_modal').modal('show');
        })
    });

    $(document).on('submit', 'form#user_edit_form', function(e) {
        e.preventDefault();
        $('form#user_edit_form').validate({
            rules: {
                name:{
                    required:true
                },
                email:{
                    required:true
                },
                phone:{
                    maxlength:8
                },
                address:{
                    required:false
                },
                business_name:{
                    required:false
                }
            }
        });

        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('div.user_modal').modal('hide');
                    toastr.success(result.msg);
                    user_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_user_button', function(){
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
                            user_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

});
