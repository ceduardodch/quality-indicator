<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador11;

class ControllerIndicator11 extends Controller
{

    public function index(Request $request)
    {
       
        
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);




        $detailindicador11_1 = Indicador11::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('SUM(amount_less_than_0_5) as register_number'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
            
        ->get();
        $json['chartData'] = $detailindicador11_1;
        $indicador11_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador11_2 = Indicador11::select(
            DB::raw('region'), 
            DB::raw('SUM(amount_less_than_0_5) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('procedimiento', $procedimiento)

            ->get();
        $json['colorMapData'] = $detailindicador11_2;
        $indicador11_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador11 = json_encode(
                array_merge(
                    json_decode($indicador11_1, true),
                    json_decode($indicador11_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador11;
    }
}
