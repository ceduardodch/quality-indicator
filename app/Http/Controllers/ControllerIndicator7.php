<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador7;

class ControllerIndicator7 extends Controller
{

    const TOP_SIZE = 10;

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));

        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);



        $detailindicador7_1 = Indicador7::select("entidad_contratante",
        DB::raw('SUM(completos) as register_number'))
        ->groupBy('entidad_contratante')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)

        ->where('procedimiento', $procedimiento)

        ->orderBy('register_number', 'desc')
        ->limit(self::TOP_SIZE)
        ->get();
        $json['chartData'] = $detailindicador7_1;
        $indicador7_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador7_2 = Indicador7::select(
            DB::raw('region'), 
            DB::raw('SUM(completos) as register_number'))
            ->groupBy('region')
            ->where('procedimiento', $procedimiento)

            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->get();
        $json['colorMapData'] = $detailindicador7_2;
        $indicador7_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador7 = json_encode(
                array_merge(
                    json_decode($indicador7_1, true),
                    json_decode($indicador7_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador7; 
    }
}
