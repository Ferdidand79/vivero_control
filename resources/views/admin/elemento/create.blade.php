<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{action('ElementoController@store',$id)}}" method="post" id="elemento_form" enctype="multipart/form-data" >
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Agregar Elemento a muestra {{$id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-group col-md-12">
                    <label for="lugar">Lugar *</label>
                    <input type="text" name="lugar" id="lugar" class="form-control" required placeholder="Ejem: Tarapoto">
                </div>
                <div class="form-group col-md-12">
                    <label for="responsable">Responsable *</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" required placeholder="Ejem: pepito">
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
                    <label for="fecha">Fecha *</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="images">Imagenes</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
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
                                    <tr style="d-flex">
                                    </tr>
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
                                    <tr style="d-flex">
                                    </tr>
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
