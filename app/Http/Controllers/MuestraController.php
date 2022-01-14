<?php

namespace App\Http\Controllers;

use App\Muestra;
use App\Planta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()){
            $muestras = Muestra::join('plantas','plantas.id','=','muestras.planta_id')
            ->select(
                'muestras.id as id',
                'muestras.ubicacion',
                'muestras.fecha',
                DB::raw('CASE muestras.estado
                WHEN "0" THEN "Inactivo"
                WHEN "1" THEN "Activo"
                END as "estado"
                '),
                'muestras.responsable',
                'plantas.nombre_comun as planta_nombre'
            )
            ->get();
            return DataTables::of($muestras)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('MuestraController@show', [$row->id]) . '" class="btn btn-xs btn-primary btn-detalle-muestra"><i class="glyphicon glyphicon-info"></i> Detalle</button>';
                $action .= '&nbsp
                            <button data-href="'. action('MuestraController@edit', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".muestra_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="' . action('MuestraController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_muestra_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.muestra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plantas = Planta::all();
        if(count($plantas) == 0){
            return view('admin.muestra.no-data');
        }
        return view('admin.muestra.create',compact(['plantas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $muestra = new Muestra();
            $muestra->planta_id = request()->get('planta');
            $muestra->ubicacion = request()->get('ubicacion');
            $muestra->estado = request()->get('estado');
            $muestra->responsable = request()->get('responsable');
            $muestra->fecha = request()->get('fecha');
            $muestra->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Muestra creada con exito'
            ];
        }catch(\Exception $e){
            DB::rollBack();
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = [
                'success'=>false,
                'msg'=>'Ocurrio un problema intentalo mas tarde'
            ];
        }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('elemento.index',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plantas = Planta::all();
        $muestra = Muestra::join('plantas','plantas.id','=','muestras.planta_id')
        ->select(
            'muestras.id as id',
            'muestras.ubicacion',
            'muestras.estado',
            'muestras.fecha',
            'muestras.responsable',
            'plantas.id as planta_id',
            'plantas.nombre_comun as planta_nombre'
        )
        ->where('muestras.id',$id)
        ->first();
        return view('admin.muestra.edit',compact(['muestra','plantas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $muestra = Muestra::find($id);
            $muestra->planta_id = request()->get('planta');
            $muestra->ubicacion = request()->get('ubicacion');
            $muestra->estado = request()->get('estado');
            $muestra->responsable = request()->get('responsable');
            $muestra->fecha = request()->get('fecha');
            $muestra->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Muestra actualizada con exito'
            ];
        }catch(\Exception $e){
            DB::rollBack();
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = [
                'success'=>false,
                'msg'=>'Ocurrio un problema intentalo mas tarde'
            ];
        }
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
