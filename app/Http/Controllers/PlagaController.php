<?php

namespace App\Http\Controllers;

use App\Plaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PlagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $plagas = Plaga::select('id','nombre','descripcion')
            ->get();

            return DataTables::of($plagas)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<button data-href="'. action('PlagaController@edit', [$row->id]) . '" class="btn btn-xs btn-primary btn-modal" data-container=".plaga_modal"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                $action .= '&nbsp
                            <button data-href="' . action('PlagaController@destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_plaga_button"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                return $action;
            })
            ->rawColumns(['action'])
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.plagas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plagas.create');
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
            $plaga = new Plaga();
            $plaga->nombre = request()->get('name');
            $plaga->descripcion = request()->get('description');
            $plaga->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Plaga creada con exito'
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
        $plaga = Plaga::findOrFail($id);
        return view('admin.plagas.edit',compact('plaga'));
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
            $plaga =  Plaga::find($id);
            $plaga->nombre = request()->get('name');
            $plaga->descripcion = request()->get('description');
            $plaga->save();
            DB::commit();
            $output = [
                'success'=>true,
                'msg'=>'Plaga actualizada con exito'
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
                $plaga = Plaga::findOrFail($id);
                $plaga->delete();
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
    public function getPlagas(){
        return Plaga::all();
    }
}
