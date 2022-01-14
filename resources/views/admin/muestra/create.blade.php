<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('MuestraController@store')}}" method="post" id="muestra_form" enctype="multipart/form-data" >
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Agregar Muestra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="planta">Planta *</label>
                    <select name="planta" id="planta" class="form-control" required>
                        <option value="">-- Seleccionar Planta --</option>
                        @foreach ($plantas as $planta)
                            <option value="{{$planta->id}}">{{$planta->nombre_comun}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="ubicacion">Ubicaciòn *</label>
                    <input type="text" name="ubicacion" id="ubicacion" class="form-control" required placeholder="Ejem: Tarapoto">
                </div>
                <div class="form-group col-md-12">
                    <label for="estado">Estado *</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">-- Seleccione Estado --</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="responsable">Responsable *</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" required placeholder="Ejem: pepito">
                </div>
                <div class="form-group col-md-12">
                    <label for="fecha">Fecha *</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
