<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador13;

class ControllerIndicator13 extends Controller
{

    const TOP_SIZE = 10;

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));




        $detailindicador13_1 = Indicador13::select("entidad_contratante",
        DB::raw('SUM(amount_less_than_0_5) as register_number'))
        ->groupBy('entidad_contratante')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->orderBy('register_number', 'desc')
        ->limit(self::TOP_SIZE)
        ->get();
        $json['chartData'] = $detailindicador13_1;
        $indicador13_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador13_2 = Indicador13::select(
            DB::raw('region'), 
            DB::raw('SUM(amount_less_than_0_5) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->get();
        $json['colorMapData'] = $detailindicador13_2;
        $indicador13_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador13 = json_encode(
                array_merge(
                    json_decode($indicador13_1, true),
                    json_decode($indicador13_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador13; 
    }
}
