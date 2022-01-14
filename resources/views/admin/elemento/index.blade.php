@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Elementos de muestra {{$id}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Elementos</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="box-tools ml-2">
                <button type="button" class="btn btn-block btn-primary btn-modal align-right"
                data-href="{{action('ElementoController@create',$id)}}"
                data-container=".elemento_modal">
                <i class="fa fa-plus"></i> Nuevo</button>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <section class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-striped" id="elementos_table">
                <thead>
                    <tr>
                        <th >Fecha</th>
                        <th >Lugar</th>
                        <th >Responsable</th>
                        <th >Estado</th>
                        <th colspan="4">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal fade elemento_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
        </div>
      </section>
</div>
@stop
@section('javascripts')
    <script type="text/javascript">
        var id_muestra = @json($id);
    </script>
    <script src="{{asset('js/elemento.js')}}" ></script>
@endsection

