<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('PlantaController@update',$planta->id)}}" method="PUT" id="planta_form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h4 class="modal-title">Editar Planta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="nombre_comun">Nombre *</label>
                    <input type="text" name="nombre_comun" id="nombre_comun" class="form-control" required value="{{$planta->nombre_comun}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="nombre_cientifico">Descripcion</label>
                    <input type="text" name="nombre_cientifico" id="nombre_cientifico" class="form-control" required value="{{$planta->nombre_cientifico}}">
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
