<?php

namespace App\Http\Controllers;

use App\Parametro;
use App\Planta;
use App\Vincular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class VincularParametrosController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $vinculaciones = Vincular::join('plantas','plantas.id','=','vincular.planta_id')
            ->join('parametros','parametros.id','vincular.parametro_id')
            ->select(
                'vincular.id as id',
                'plantas.nombre_comun as planta_nombre',
                'parametros.nombre as parametro_nombre',
                'vincular.valor_min as valor_min',
                'vincular.valor_max as valor_max'
            )
            ->get();
            return DataTables::of($vinculaciones)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('VincularParametrosController@edit', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".vincular_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="' . action('VincularParametrosController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_vincular_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.vincular.index');
    }

    public function show($id){

    }

    public function create(){
        $plantas = Planta::all();
        $parametros = Parametro::all();
        if(count($plantas) == 0 || count($parametros) == 0){
            return view('admin.vincular.no-data');
        }
        return view('admin.vincular.create',compact(['plantas','parametros']));
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $vinculacion = new Vincular();
            $vinculacion->planta_id = request()->get('planta');
            $vinculacion->parametro_id = request()->get('parametro');
            $vinculacion->valor_min = request()->get('valor_min');
            $vinculacion->valor_max = request()->get('valor_max');
            $vinculacion->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Vinculación creada con exito'
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

    public function edit($id){
        $plantas = Planta::all();
        $parametros = Parametro::all();
        $vinculacion = Vincular::join('plantas','plantas.id','=','vincular.planta_id')
            ->join('parametros','parametros.id','vincular.parametro_id')
            ->select(
                'vincular.id as id',
                'plantas.id as planta_id',
                'plantas.nombre_comun as planta_nombre',
                'parametros.id as parametro_id',
                'parametros.nombre as parametro_nombre',
                'vincular.valor_min as valor_min',
                'vincular.valor_max as valor_max'
            )
            ->where('vincular.id',$id)
            ->first();
        return view('admin.vincular.edit',compact(['vinculacion','parametros','plantas']));
    }

    public function update(Request $request,$id){
        try{
            DB::beginTransaction();
            $vinculacion = Vincular::find($id);
            $vinculacion->planta_id = request()->get('planta');
            $vinculacion->parametro_id = request()->get('parametro');
            $vinculacion->valor_min = request()->get('valor_min');
            $vinculacion->valor_max = request()->get('valor_max');
            $vinculacion->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Vinculación actualizada con exito'
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

    public function destroy($id){
        if(request()->ajax()){
            try {
                DB::beginTransaction();
                $vinculacion = Vincular::findOrFail($id);
                $vinculacion->delete();
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
