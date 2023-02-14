<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Indicador1;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class ControllerIndicator1 extends Controller
{
     
    public function index(Request $request)
    {
       
        
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
        $proceso = filter_var($request->proceso, FILTER_SANITIZE_STRING);




        $detailindicador1_1 = Indicador1::select(
        DB::raw('year||\'.\'||month as yearmonth'), 
        DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
        ->groupBy('year', 'month')
        ->whereBetween('fecha', [$mindate, $maxdate])
        ->whereIn('region', $region)
        ->where('proceso', $proceso)
        ->get();
        $json['chartData'] = $detailindicador1_1;
        $indicador1_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $detailindicador1_2 = Indicador1::select(
            DB::raw('region'), 
            DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
            ->groupBy('region')
            ->whereBetween('fecha', [$mindate, $maxdate])
            ->whereIn('region', $region)
            ->where('proceso', $proceso)
            ->get();
        $json['colorMapData'] = $detailindicador1_2;
        $indicador1_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        $indicador1 = json_encode(
                array_merge(
                    json_decode($indicador1_1, true),
                    json_decode($indicador1_2, true)
                ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
       
        return $indicador1;
    }
    // Excel Export
    // public function exportExcel(Request $request){
    //     $file_name = 'employees_'.date('Y_m_d_H_i_s').'.xlsx';
    //     return Excel::download(new collection($request), $file_name);
    //  }



    //  public function collection(Request $request)
    // {
       
        
    //     $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
    //     $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
    //     $region =  explode(',', str_replace(array("[", '"', "]"), "", $request->region));
    //     $proceso = filter_var($request->proceso, FILTER_SANITIZE_STRING);




    //     $detailindicador1_1 = Indicador1::select(
    //     DB::raw('year||\'.\'||month as yearmonth'), 
    //     DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
    //     ->groupBy('year', 'month')
    //     ->whereBetween('fecha', [$mindate, $maxdate])
    //     ->whereIn('region', $region)
    //     ->where('proceso', $proceso)
    //     ->get();
    //     $json['indicador1_1'] = $detailindicador1_1;
    //     $indicador1_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

    //     $detailindicador1_2 = Indicador1::select(
    //         DB::raw('region'), 
    //         DB::raw('ROUND(AVG(porcentaje*100)::numeric,2) as porcentaje'))
    //         ->groupBy('region')
    //         ->whereBetween('fecha', [$mindate, $maxdate])
    //         ->whereIn('region', $region)
    //         ->where('proceso', $proceso)
    //         ->get();
    //     $json['indicador1_2'] = $detailindicador1_2;
    //     $indicador1_2 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

    //     $indicador1 = json_encode(
    //             array_merge(
    //                 json_decode($indicador1_1, true),
    //                 json_decode($indicador1_2, true)
    //             ),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    //             );
       
    //     return $indicador1;
    // }
}
