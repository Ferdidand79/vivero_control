<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Parametro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $parametros = Parametro::select('id','nombre','descripcion')
            ->get();

            return DataTables::of($parametros)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('ParametroController@edit', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".parametro_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="' . action('ParametroController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_parametro_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.parametros.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parametros.create');
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
            $parametro = new Parametro();
            $parametro->nombre = request()->get('name');
            $parametro->descripcion = request()->get('description');
            $parametro->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Parametro creado con exito'
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
        $parametro = Parametro::findOrFail($id);
        return view('admin.parametros.edit',compact('parametro'));
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
            $parametro =  Parametro::find($id);
            $parametro->nombre = request()->get('name');
            $parametro->descripcion = request()->get('description');
            $parametro->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Parametro actualizado con exito'
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
                $parametro = Parametro::findOrFail($id);
                $parametro->delete();
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

    public function getParametros(){
        return Parametro::all();
    }
}
