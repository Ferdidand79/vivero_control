<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('MuestraController@update',$muestra->id)}}" method="PUT" id="muestra_form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h4 class="modal-title">Editar Muestra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="planta">Planta *</label>
                    <select name="planta" id="planta" class="form-control" required>
                        <option value="">-- Seleccionar Planta --</option>
                        @foreach ($plantas as $planta)
                            <option value="{{$planta->id}}" @if ($planta->id == $muestra->planta_id)
                                {{'selected'}}
                            @endif>{{$planta->nombre_comun}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="ubicacion">Ubicaciòn *</label>
                    <input type="text" name="ubicacion" id="ubicacion" class="form-control" required placeholder="Ejem: Tarapoto" value="{{$muestra->ubicacion}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="estado">Estado *</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">-- Seleccione Estado --</option>
                        <option value="0" {{$muestra->estado == '0' ? 'selected' : ''}}>Inactivo</option>
                        <option value="1" {{$muestra->estado == '1' ? 'selected' : ''}}>Activo</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="responsable">Responsable *</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" required placeholder="Ejem: pepito" value="{{$muestra->responsable}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="fecha">Fecha *</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required value="{{$muestra->fecha}}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
