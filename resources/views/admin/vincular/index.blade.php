@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Vincular Parametros</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Vincular</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="box-tools ml-2">
                <button type="button" class="btn btn-block btn-primary btn-modal align-right"
                data-href="{{action('VincularParametrosController@create')}}"
                data-container=".vincular_modal">
                <i class="fa fa-plus"></i> Nuevo</button>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <section class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-striped" id="vincular_table">
                <thead>
                    <tr>
                        <th >Planta</th>
                        <th >Parametro</th>
                        <th >Valor Mínimo</th>
                        <th >Valor Máximo</th>
                        <th colspan="4">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal fade vincular_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
        </div>
      </section>
</div>
@stop
@section('javascripts')
<script src="{{asset('js/vincular.js')}}"></script>
@endsection

