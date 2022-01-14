<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('VincularParametrosController@store')}}" method="post" id="vincular_form" enctype="multipart/form-data" >
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Agregar Vinculación</h4>
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
                    <label for="parametro">Parámetro</label>
                    <select name="parametro" id="parametro" class="form-control" required>
                        <option value="">-- Seleccionar Parametro --</option>
                        @foreach ($parametros as $parametro)
                            <option value="{{$parametro->id}}">{{$parametro->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="valor_min">Valor Mínimo</label>
                    <input type="text" name="valor_min" id="valor_min" class="form-control" required placeholder="Ejem: 1cm">
                </div>
                <div class="form-group col-md-12">
                    <label for="valor_max">Valor Máximo</label>
                    <input type="text" name="valor_max" id="valor_max" class="form-control" required placeholder="Ejem: 5cm">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
