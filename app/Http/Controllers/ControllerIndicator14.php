<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador14;

class ControllerIndicator14 extends Controller
{

    public function index(Request $request)
    {
       
        
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);




        $detailindicador14_1 = Indicador14::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('SUM(amount_diff) as register_number'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
        ->get();
        $json['indicador14_1'] = $detailindicador14_1;
        $indicador14_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador14_2 = Indicador14::select(
            DB::raw('region'), 
            DB::raw('SUM(amount_diff) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('procedimiento', $procedimiento)
            ->get();
        $json['indicador14_2'] = $detailindicador14_2;
        $indicador14_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador14 = json_encode(
                array_merge(
                    json_decode($indicador14_1, true),
                    json_decode($indicador14_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador14;
    }
}
