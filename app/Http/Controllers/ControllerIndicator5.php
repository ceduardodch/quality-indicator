<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador5;

class ControllerIndicator5 extends Controller
{
    const TOP_SIZE = 10;

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));




        $detailindicador5_1 = Indicador5::select("entidad_contratante",
        DB::raw('SUM(completos) as register_number'))
        ->groupBy('entidad_contratante')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->orderBy('register_number', 'desc')
        ->limit(self::TOP_SIZE)
        ->get();
        $json['indicador5_1'] = $detailindicador5_1;
        $indicador5_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador5_2 = Indicador5::select(
            DB::raw('region'), 
            DB::raw('SUM(completos) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->get();
        $json['indicador5_2'] = $detailindicador5_2;
        $indicador5_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador5 = json_encode(
                array_merge(
                    json_decode($indicador5_1, true),
                    json_decode($indicador5_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador5; 
    }
}
