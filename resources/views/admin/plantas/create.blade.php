<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('PlantaController@store')}}" method="post" id="planta_form" enctype="multipart/form-data" >
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Agregar Planta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="nombre_comun">Nombre Común *</label>
                    <input type="text" name="nombre_comun" id="nombre_comun" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="nombre_cientifico">Nombre Científico</label>
                    <input type="text" name="nombre_cientifico" id="nombre_cientifico" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
