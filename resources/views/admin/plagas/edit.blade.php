<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('PlagaController@update',$plaga->id)}}" method="PUT" id="plaga_form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h4 class="modal-title">Editar Plaga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="name">Nombre *</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{$plaga->nombre}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="description">Descripcion</label>
                    <textarea name="description" id="description" cols="30" rows="10"  class="form-control">{{$plaga->descripcion}}</textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
