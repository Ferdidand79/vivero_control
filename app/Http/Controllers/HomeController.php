<?php

namespace App\Http\Controllers;

use App\ElementoParametro;
use App\ElementoPlaga;
use App\Plaga;
use App\Planta;
use App\Vincular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $request = request()->all();
        $mesNivelPlaga = $mesPlagaPresente = $mesSatisfaccion = null;
        $ordenPlagaPresente = 'asc';
        $array_nivel = [];
        $array_plagaPresente = [];
        $array_umbral = [];
        $array_plagas = [];
        $satisfaccion = [];

        // Nivel de Plagas

        if(isset($request['plaga_nivel_mes'])){
            $mesNivelPlaga = $request['plaga_nivel_mes'];
        }
        $array_nivel = $this->nivelPlagasPercent($mesNivelPlaga);

        // Plagas que mas se presentan

        if(isset($request['plaga_presente_mes'])){
            $mesPlagaPresente = $request['plaga_presente_mes'];
        }

        if(isset($request['orden_plaga_presente'])){
            $ordenPlagaPresente = $request['orden_plaga_presente'];
        }

        $array_plagas = $this->plagasPresentesPercent($mesPlagaPresente,$ordenPlagaPresente)['array_plagas'];
        $array_plagaPresente = $this->plagasPresentesPercent($mesPlagaPresente,$ordenPlagaPresente)['array_plagaPresente'];

        // Plantas fuera del umbral
        $array_umbral = $this->getPercentPlantaDentroUmbral();

        // Satisfaccion

        if(isset($request['filter_satisfaccion_mes'])){
            $mesSatisfaccion = $request['filter_satisfaccion_mes'];
        }

        $satisfaccion = $this->getPercentPlantaDentroUmbral(true,$mesSatisfaccion);

        return view('home',compact(
            'mesNivelPlaga',
            'mesPlagaPresente',
            'mesSatisfaccion',
            'array_nivel',
            'array_plagas',
            'array_plagaPresente',
            'array_umbral',
            'satisfaccion',
            'ordenPlagaPresente'));
    }

    public function nivelPlagasPercent($mesNivelPlaga){
        $totalPlagasNivel = 0;
        $array_nivel = [];
        $numeroPlagasPorNivel = ElementoPlaga::join('plagas','plagas.id','elemento_plaga.plaga_id')
        ->select(
            'elemento_plaga.nivel',
            DB::raw('count(*) as numero' )
        );
        if(isset($mesNivelPlaga)){
            $numeroPlagasPorNivel = $numeroPlagasPorNivel->whereMonth('elemento_plaga.created_at',$mesNivelPlaga);
        }
        $numeroPlagasPorNivel = $numeroPlagasPorNivel->groupBy('elemento_plaga.nivel')->get();
        foreach($numeroPlagasPorNivel as $plaga){
            $totalPlagasNivel += $plaga->numero;
        }

        if($totalPlagasNivel>0){
            foreach($numeroPlagasPorNivel as $plaga){
                array_push($array_nivel,number_format(($plaga->numero/$totalPlagasNivel)*100,2));
            }
        }

        return $array_nivel;
    }

    public function plagasPresentesPercent($mesPlagaPresente,$ordenPlagaPresente){
        $totalPlagasPresentes = 0;
        $array_plagas = [];
        $array_plagaPresente = [];

        $numeroPlagasPresentes = ElementoPlaga::join('plagas','plagas.id','elemento_plaga.plaga_id')
        ->select(
            'plagas.nombre',
            DB::raw('count(*) as cantidad')
        );

        if(isset($mesPlagaPresente)){
            $numeroPlagasPresentes = $numeroPlagasPresentes->whereMonth('elemento_plaga.created_at',$mesPlagaPresente);
        }

        $numeroPlagasPresentes = $numeroPlagasPresentes->groupBy('elemento_plaga.plaga_id','plagas.nombre');

        if(isset($ordenPlagaPresente)){
            $numeroPlagasPresentes = $numeroPlagasPresentes->orderBy('cantidad',$ordenPlagaPresente);
        }

        $numeroPlagasPresentes = $numeroPlagasPresentes->get();

        foreach($numeroPlagasPresentes as $plagaPresente){

            $totalPlagasPresentes += $plagaPresente->cantidad;
            array_push($array_plagas,$plagaPresente->nombre);

        }

        if($totalPlagasPresentes>0){
            foreach($numeroPlagasPresentes as $plagaPresente){
                array_push($array_plagaPresente,number_format(($plagaPresente->cantidad/$totalPlagasPresentes)*100,2));
            }
        }

        return [
            'array_plagas' => $array_plagas,
            'array_plagaPresente' => $array_plagaPresente
        ];
    }

    public function getPercentPlantaDentroUmbral($is_satisfaccion=false,$mesSatisfaccion=null){
        $array_umbral = [];

        $countDentroUmbral = $countFueraUmbral = $totalUmbral = 0;

        $umbrales = $umbrales = ElementoParametro::join('parametros','parametros.id','elemento_parametro.parametro_id')
        ->select(
            'elemento_parametro.parametro_id',
            'elemento_parametro.valor'
        );
        if($is_satisfaccion){
            if(isset($mesSatisfaccion)){
                $umbrales = $umbrales->whereMonth('elemento_parametro.created_at',$mesSatisfaccion);
            }
            $umbrales = $umbrales->get();
        }else{
            $umbrales = $umbrales->get();
        }

        foreach($umbrales as $umbral){
            $vinculacion = Vincular::where('parametro_id',$umbral->parametro_id);
            if($is_satisfaccion){
                if(isset($mesSatisfaccion)){
                    $vinculacion = $vinculacion->whereMonth('created_at',$mesSatisfaccion);
                }
                $vinculacion = $vinculacion->first();
            }else{
                $vinculacion = $vinculacion->first();
            }
            if($vinculacion->parametro_id == $umbral->parametro_id){
                if($umbral->valor>=$vinculacion->valor_min && $umbral->valor<=$vinculacion->valor_max){
                    $countDentroUmbral++;
                }else{
                    $countFueraUmbral++;
                }

            }
        }

        $totalUmbral = $countDentroUmbral + $countFueraUmbral;
        if($totalUmbral > 0){
            array_push($array_umbral,number_format(($countDentroUmbral/$totalUmbral)*100,2));
            array_push($array_umbral,number_format(($countFueraUmbral/$totalUmbral)*100,2));
        }

        return $array_umbral;
    }
}
