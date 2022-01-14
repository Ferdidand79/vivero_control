<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('ImageController@store',$elemento_id)}}" method="post" id="image_add_form" enctype="multipart/form-data" >
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Agregar Imagen para el elemento {{$elemento_id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="image">Imagen (Multiple)</label>
                    <input type="file" name="images[]" id="image" multiple class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
