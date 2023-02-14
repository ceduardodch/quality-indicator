<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador15;

class ControllerIndicator15 extends Controller
{

    public function index(Request $request)
    {
       
        
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);




        $detailindicador15_1 = Indicador15::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('ROUND(SUM(variabilidad),2) as variabilidad'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
        ->get();
        $json['chartData'] = $detailindicador15_1;
        $indicador15_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador15_2 = Indicador15::select(
            DB::raw('region'), 
            DB::raw('ROUND(SUM(variabilidad),2) as variabilidad'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('procedimiento', $procedimiento)
            ->get();
        $json['colorMapData'] = $detailindicador15_2;
        $indicador15_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador15 = json_encode(
                array_merge(
                    json_decode($indicador15_1, true),
                    json_decode($indicador15_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador15;
    }
}
