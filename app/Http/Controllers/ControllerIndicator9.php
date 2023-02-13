<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador9;

class ControllerIndicator9 extends Controller
{

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);




        $detailindicador9_1 = Indicador9::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
        ->get();
        $json['indicador4_1'] = $detailindicador9_1;
        $indicador9_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador9_2 = Indicador9::select(
            DB::raw('region'), 
            DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('procedimiento', $procedimiento)
            ->get();
        $json['indicador9_2'] = $detailindicador9_2;
        $indicador9_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador9 = json_encode(
                array_merge(
                    json_decode($indicador9_1, true),
                    json_decode($indicador9_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador9;
    }
}
