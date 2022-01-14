<?php

namespace App\Http\Controllers;

use App\Planta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PlantaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $plantas = Planta::select('id','nombre_comun','nombre_cientifico')
            ->get();

            return DataTables::of($plantas)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('PlantaController@edit', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".planta_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="' . action('PlantaController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_planta_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.plantas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plantas.create');
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
            $planta = new Planta();
            $planta->nombre_comun = request()->get('nombre_comun');
            $planta->nombre_cientifico = request()->get('nombre_cientifico');
            $planta->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Planta creada con exito'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planta = Planta::findOrFail($id);
        return view('admin.plantas.edit',compact('planta'));
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
            $planta =  Planta::find($id);
            $planta->nombre_comun = request()->get('nombre_comun');
            $planta->nombre_cientifico = request()->get('nombre_cientifico');
            $planta->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Planta actualizada con exito'
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
        if(request()->ajax()){
            try {
                DB::beginTransaction();
                $planta = Planta::findOrFail($id);
                $planta->delete();
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
