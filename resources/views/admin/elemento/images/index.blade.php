@extends('admin.layouts.app')
@section('title',"Imagenes de Elemento {{$elemento_id}}")
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Imagenes de Elemento {{$elemento_id}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Imagenes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <button type="button" class="btn btn-block btn-primary btn-modal align-right"
                    data-href="{{action('ImageController@create',$elemento_id)}}"
                    data-container=".image_modal">
                    <i class="fa fa-plus"></i> Subir Imagen</button>
                </div>

                <div class="row text-center" style="margin-top: 2rem">
                    @foreach ($images as $image)
                        <div class="card col-md-4 col-sm-3 col-xs-12 col-lg-4 ml-2" style="width: 18rem;">
                            <img class="img-fluid mb-3 rounded-sm p-4" src="{{Storage::url($image->url)}}" alt="Photo"  max-height="200px">
                            <div class="card-body p-2" style="margin-top: 1rem">
                                <button data-href="{{action('ImageController@destroy',[$image->id])}}" class="btn btn-danger btn-sm text-center delete_image_button">Eliminar</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </section>
    {{$images->links()}}
    <div class="modal fade image_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
</div>
@stop
@section('javascripts')
    <script src="{{asset('js/image.js')}}"></script>
@endsection
