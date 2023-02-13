<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Indicador2;

class ControllerIndicator2 extends Controller
{

    public function index(Request $request)
    {

        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $proceso = filter_var($request->proceso, FILTER_SANITIZE_STRING);




        $detailindicador2_1 = Indicador2::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('proceso', $proceso)
        ->get();
        $json['indicador2_1'] = $detailindicador2_1;
        $indicador2_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador2_2 = Indicador2::select(
            DB::raw('region'), 
            DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('proceso', $proceso)
            ->get();
        $json['indicador2_2'] = $detailindicador2_2;
        $indicador2_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador2 = json_encode(
                array_merge(
                    json_decode($indicador2_1, true),
                    json_decode($indicador2_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador2;



    
    }
}
