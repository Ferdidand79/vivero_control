<?php

namespace App\Http\Controllers;

use App\Elemento;
use App\ElementoParametro;
use App\ElementoPlaga;
use App\Image;
use App\Parametro;
use App\Plaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        if(request()->ajax()){
            $elementos = Elemento::where('muestra_id',request()->get('id'))
            ->select(
                'id',
                'fecha',
                'muestra_id',
                'lugar',
                'responsable',
                DB::raw('CASE estado
                WHEN "0" THEN "Inactivo"
                WHEN "1" THEN "Activo"
                END "estado"')
            )
            ->get();
            return DataTables::of($elementos)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('ElementoController@show', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".elemento_modal"><i class="glyphicon glyphicon-info"></i> Detalle</button>';
                $action .= '&nbsp
                            <button data-href="'. action('ElementoController@edit', [$row->muestra_id,$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".elemento_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="'. action('ElementoController@showImages', [$row->id]) . '" class="btn btn-xs btn-success galeria_button"><i class="glyphicon glyphicon-info"></i> Galeria</button>';
                $action .= '&nbsp
                            <button data-href="' . action('ElementoController@destroy', [$row->muestra_id,$row->id]) . '" class="btn btn-xs btn-danger delete_elemento_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }
        return view('admin.elemento.index',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showImages($elemento_id){
        return redirect()->route('elemento.show-images',$elemento_id);
    }

    public function create($id)
    {
        return view('admin.elemento.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $elemento = new Elemento();
            $elemento->muestra_id = $id;
            $elemento->fecha = request()->get('fecha');
            $elemento->lugar = request()->get('lugar');
            $elemento->estado = request()->get('estado');
            $elemento->responsable = request()->get('responsable');
            $elemento->save();

            if($request->hasFile('images')){
                $files = $request->file('images');
                foreach ($files as $file) {
                    # code...
                    $filename = $file->getFileName().'.'.$file->getClientOriginalExtension();
                    Storage::disk('public')->put( $filename, File::get($file));
                    $image = new Image();
                    $image->elemento_id = $elemento->id;
                    $image->url = $filename;
                    $image->save();
                }
            }

            if(request()->get('parametros')){
                $parametros = request()->get('parametros');
                $valorParametros = request()->get('valorParametro');
                foreach ($parametros as $key => $value) {
                    $elemento_parametro = new ElementoParametro();
                    $elemento_parametro->elemento_id = $elemento->id;
                    $elemento_parametro->parametro_id = $value;
                    $elemento_parametro->valor = $valorParametros[$key];
                    $elemento_parametro->save();
                }
            }
            if(request()->get('plagas')){
                $plagas = request()->get('plagas');
                $valorPlaga = request()->get('valorPlaga');
                $niveles = request()->get('niveles');
                foreach ($plagas as $key => $value) {
                    $elemento_plaga = new ElementoPlaga();
                    $elemento_plaga->elemento_id = $elemento->id;
                    $elemento_plaga->plaga_id = $value;
                    $elemento_plaga->valor = $valorPlaga[$key];
                    $elemento_plaga->nivel = $niveles[$key];
                    $elemento_plaga->save();
                }
            }
            DB::commit();
            $output = ['success' => true,
                        'msg' => "Elemento creado con exito"];
        } catch (\Exception $e) {
             DB::rollBack();
                Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                $output = ['success' => false,
                        'msg' => "Ocurrio un problema, intentalo mas tarde"];
        }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($elemento_id)
    {
        $elemento = Elemento::with('image')
        ->select(
            'elementos.muestra_id',
            'elementos.fecha',
            'elementos.lugar',
            'elementos.responsable',
            DB::raw('CASE elementos.estado
            WHEN "0" THEN "Inactivo"
            WHEN "1" THEN "Activo"
            END "estado_elemento"')
        )
        ->where('elementos.id',$elemento_id)
        ->first();

        $elementos_parametro = ElementoParametro::join('parametros','elemento_parametro.parametro_id','parametros.id')
        ->select(
            'parametros.nombre as parametro_nombre',
            'elemento_parametro.valor as parametro_valor'
        )
        ->where('elemento_parametro.elemento_id',$elemento_id)
        ->get();
        $elementos_plaga = ElementoPlaga::join('plagas','elemento_plaga.plaga_id','plagas.id')
        ->select(
            'plagas.nombre as plaga_nombre',
            'elemento_plaga.valor as plaga_valor',
            'elemento_plaga.nivel as plaga_nivel'
        )
        ->where('elemento_plaga.elemento_id',$elemento_id)
        ->get();
        return view('admin.elemento.show',compact('elemento','elementos_parametro','elementos_plaga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$elemento_id)
    {
        $elemento = Elemento::with('image')
        ->select(
            'elementos.id as elemento_id',
            'elementos.muestra_id',
            'elementos.fecha',
            'elementos.lugar',
            'elementos.responsable',
            'elementos.estado'
        )
        ->where('elementos.id',$elemento_id)
        ->first();

        $elementos_parametro = ElementoParametro::join('parametros','elemento_parametro.parametro_id','parametros.id')
        ->select(
            'elemento_parametro.parametro_id as parametro_id',
            'parametros.nombre as parametro_nombre',
            'elemento_parametro.valor as parametro_valor'
        )
        ->where('elemento_parametro.elemento_id',$elemento_id)
        ->get();
        $elementos_plaga = ElementoPlaga::join('plagas','elemento_plaga.plaga_id','plagas.id')
        ->select(
            'elemento_plaga.plaga_id as plaga_id',
            'plagas.nombre as plaga_nombre',
            'elemento_plaga.valor as plaga_valor',
            'elemento_plaga.nivel as plaga_nivel'
        )
        ->where('elemento_plaga.elemento_id',$elemento_id)
        ->get();
        $parametros = Parametro::all();
        $plagas = Plaga::all();
        return view('admin.elemento.edit',compact('id','elemento','elementos_parametro','elementos_plaga','parametros','plagas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$elemento_id)
    {
        try {
            DB::beginTransaction();

            ElementoParametro::where('elemento_id',$elemento_id)->delete();
            ElementoPlaga::where('elemento_id',$elemento_id)->delete();

            $elemento = Elemento::find($elemento_id);
            $elemento->muestra_id = $id;
            $elemento->fecha = request()->get('fecha');
            $elemento->lugar = request()->get('lugar');
            $elemento->estado = request()->get('estado');
            $elemento->responsable = request()->get('responsable');
            $elemento->save();

            if(request()->get('parametros')){
                $parametros = request()->get('parametros');
                $valorParametros = request()->get('valorParametro');
                foreach ($parametros as $key => $value) {
                    $elemento_parametro = new ElementoParametro();
                    $elemento_parametro->elemento_id = $elemento_id;
                    $elemento_parametro->parametro_id = $value;
                    $elemento_parametro->valor = $valorParametros[$key];
                    $elemento_parametro->save();
                }
            }
            if(request()->get('plagas')){
                $plagas = request()->get('plagas');
                $valorPlaga = request()->get('valorPlaga');
                $niveles = request()->get('niveles');
                foreach ($plagas as $key => $value) {
                    $elemento_plaga = new ElementoPlaga();
                    $elemento_plaga->elemento_id = $elemento_id;
                    $elemento_plaga->plaga_id = $value;
                    $elemento_plaga->valor = $valorPlaga[$key];
                    $elemento_plaga->nivel = $niveles[$key];
                    $elemento_plaga->save();
                }
            }

            DB::commit();
            $output = ['success'=>true,
                'msg' => 'Elemento actualizado con exito'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => false,
                    'msg' => "Ocurrio un problema, intentalo mas tarde"];
        }
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$elemento_id)
    {
        if(request()->ajax()){
            try {
                DB::beginTransaction();
                $elemento = Elemento::findOrFail($elemento_id);
                $elemento->delete();
                DB::commit();
                $output = ['success' => true,
                'msg' => "Eliminado con exito"
                ];
            }catch(\Exception $e){
                DB::rollBack();
                Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                $output = ['success' => false,
                        'msg' => "Ocurrio un problema, intentalo mas tarde"];
            }
            return $output;
        }
    }

}
