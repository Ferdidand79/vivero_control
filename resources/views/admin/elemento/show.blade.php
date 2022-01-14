<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Detalle de Elemento</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body justify-content-center">
            <div class="row">
                <div class="col-md-6"><label>Lugar</label></div>
                <div class="col-md-6">{{$elemento->lugar}}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><label>Responsable</label></div>
                <div class="col-md-6">{{$elemento->responsable}}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><label>Estado</label></div>
                <div class="col-md-6">{{$elemento->estado_elemento}}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><label>Fecha</label></div>
                <div class="col-md-6">{{$elemento->fecha}}</div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex flex-start">
                        <h6 class="text-bold">Parametros</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dynamic_field">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($elementos_parametro as $parametro)
                                        <tr style="d-flex mb-3">
                                            <td class="col-md-6">{{$parametro->parametro_nombre}}</td>
                                            <td class="col-md-6">{{$parametro->parametro_valor}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No hay datos de parametros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex flex-start align-items-center">
                        <h6 class="text-bold">Plagas</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dynamic_field_plaga">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor</th>
                                        <th>Nivel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="d-flex">
                                        @forelse ($elementos_plaga as $plaga)
                                            <tr style="d-flex mb-3">
                                                <td class="col-md-4">{{$plaga->plaga_nombre}}</td>
                                                <td class="col-md-4">{{$plaga->plaga_valor}}</td>
                                                <td class="col-md-4">
                                                    @switch($plaga->plaga_nivel)
                                                        @case('0')
                                                            Bajo
                                                            @break
                                                        @case('1')
                                                            Medio
                                                            @break
                                                        @case('2')
                                                            Alto
                                                            @break
                                                        @default

                                                    @endswitch
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>No hay datos de plagas</td>
                                            </tr>
                                        @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
