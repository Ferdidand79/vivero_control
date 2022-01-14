<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('ElementoController@update',[$id,$elemento->elemento_id])}}" method="PUT" id="elemento_form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h4 class="modal-title">Editar Elemento de muestra {{$id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-group col-md-12">
                    <label for="lugar">Lugar *</label>
                    <input type="text" name="lugar" id="lugar" class="form-control" required placeholder="Ejem: Tarapoto" value="{{$elemento->lugar}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="responsable">Responsable *</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" required placeholder="Ejem: pepito" value="{{$elemento->responsable}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="estado">Estado *</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">-- Seleccione Estado --</option>
                        <option value="0" {{$elemento->estado == '0' ? 'selected' : ''}}>Inactivo</option>
                        <option value="1" {{$elemento->estado == '1' ? 'selected' : ''}}>Activo</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="fecha">Fecha *</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required value="{{$elemento->fecha}}">
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex flex-start align-items-center">
                          <h6 class="text-bold">Parametros</h6>
                          <button type="button" class="btn btn-success ml-3" name="add" id="add">
                            <i class="fa fa-plus"></i></button>
                          </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered" id="dynamic_field">
                                    @foreach ($elementos_parametro as $parametro)
                                        <tr id="row{{$loop->iteration}}" style="d-flex">
                                            <td>
                                                <select name="parametros[]" class="form-control name_list" required>
                                                    <option value="">-- Seleccione parametro --</option>
                                                    @foreach ($parametros as $item)
                                                        <option value="{{$item->id}}" {{$parametro->parametro_id == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="valorParametro[]" placeholder="Ingrese su valor" class="form-control name_list" required value={{$parametro->parametro_valor}} />
                                            </td>
                                            <td><button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove">X</button></td></tr>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex flex-start align-items-center">
                          <h6 class="text-bold">Plagas</h6>
                          <button type="button" class="btn btn-success ml-3" name="add-plaga" id="add-plaga">
                            <i class="fa fa-plus"></i></button>
                          </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered" id="dynamic_field_plaga">
                                    @foreach ($elementos_plaga as $plaga)
                                    <tr id="rowplaga{{$loop->iteration}}" style="d-flex">
                                        <td>
                                            <select name="plagas[]" class="form-control name_list_plaga" required>
                                                <option value="">-- Seleccione plaga --</option>
                                                @foreach ($plagas as $item)
                                                    <option value="{{$item->id}}" {{$plaga->plaga_id == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="valorPlaga[]" placeholder="Ingrese su valor" class="form-control name_list" required value={{$plaga->plaga_valor}} />
                                        </td>
                                        <td>
                                            <select name="niveles[]" class="form-control">
                                                <option value="0" {{$plaga->plaga_nivel == '0' ? 'selected' : ''}}>Bajo</option>
                                                <option value="1" {{$plaga->plaga_nivel == '1' ? 'selected' : ''}}>Medio</option>
                                                <option value="2" {{$plaga->plaga_nivel == '2' ? 'selected' : ''}}>Alto</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn_remove_plaga">X</button></td></tr>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
    </div>
</div>
