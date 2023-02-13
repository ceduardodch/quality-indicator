<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador8;

class ControllerIndicator8 extends Controller
{
    const TOP_SIZE = 10;

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));

        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);



        $detailindicador8_1 = Indicador8::select("entidad_contratante",
        DB::raw('SUM(completos) as register_number'))
        ->groupBy('entidad_contratante')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('procedimiento', $procedimiento)
        ->orderBy('register_number', 'desc')
        ->limit(self::TOP_SIZE)
        ->get();
        $json['indicador8_1'] = $detailindicador8_1;
        $indicador8_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador8_2 = Indicador8::select(
            DB::raw('region'), 
            DB::raw('SUM(completos) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->where('procedimiento', $procedimiento)
            ->whereIn('region', $region)
            ->get();
        $json['indicador8_2'] = $detailindicador8_2;
        $indicador8_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador8 = json_encode(
                array_merge(
                    json_decode($indicador8_1, true),
                    json_decode($indicador8_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador8; 
    }
}
