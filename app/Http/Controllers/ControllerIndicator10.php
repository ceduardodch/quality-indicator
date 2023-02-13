<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador10;

class ControllerIndicator10 extends Controller
{

    public function index(Request $request)
    {
       
        
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);




        $detailindicador10_1 = Indicador10::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('COUNT(amount_less_than_0_5) as register_number'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
        ->get();
        $json['indicador10_1'] = $detailindicador10_1;
        $indicador10_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador10_2 = Indicador10::select(
            DB::raw('region'), 
            DB::raw('COUNT(amount_less_than_0_5) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('procedimiento', $procedimiento)
            ->get();
        $json['indicador10_2'] = $detailindicador10_2;
        $indicador10_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador10 = json_encode(
                array_merge(
                    json_decode($indicador10_1, true),
                    json_decode($indicador10_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador10;
    }
}
