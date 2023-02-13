<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador12;

class ControllerIndicator12 extends Controller
{

    const TOP_SIZE = 10;

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));




        $detailindicador12_1 = Indicador12::select("entidad_contratante",
        DB::raw('SUM(amount_less_than_0_5) as register_number'))
        ->groupBy('entidad_contratante')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->orderBy('register_number', 'desc')
        ->limit(self::TOP_SIZE)
        ->get();
        $json['indicador12_1'] = $detailindicador12_1;
        $indicador12_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador12_2 = Indicador12::select(
            DB::raw('region'), 
            DB::raw('SUM(amount_less_than_0_5) as register_number'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->get();
        $json['indicador12_2'] = $detailindicador12_2;
        $indicador12_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador12 = json_encode(
                array_merge(
                    json_decode($indicador12_1, true),
                    json_decode($indicador12_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                ); 
                return $indicador12; 
    }
}