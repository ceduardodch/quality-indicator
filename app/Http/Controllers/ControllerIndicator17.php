<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Indicador17;

class ControllerIndicator17 extends Controller
{

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);
        
        $detailindicador17_1 = Indicador17::select(
        DB::raw('json_build_object(yearmonth, json_agg(ROUND(monto_adjudicado,2))) as data'))
        ->groupBy('yearmonth')
        ->whereBetween('yearmonth', [$mindate, $maxdate])
        ->where('procedimiento', $procedimiento)
        ->get();
        $indicador17f=array();
        foreach ($detailindicador17_1 as $key => $value) {
            $value1 =  str_replace(array("{", "}", "\"","\\", '"'), "", json_encode($value['data']));
             array_push($indicador17f ,$value1);
        }
        $json['chartData'] = $indicador17f;
        $indicador17_1 = json_encode($json,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); 

        return $indicador17_1;
        
    }
}
