<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Indicador16;

class ControllerIndicator16 extends Controller
{

    public function index(Request $request)
    {
        $maxdate = filter_var($request->maxdate, FILTER_SANITIZE_STRING);
        $mindate = filter_var($request->mindate, FILTER_SANITIZE_STRING);
        $procedimiento = filter_var($request->procedimiento, FILTER_SANITIZE_STRING);
        
        $indicador16 = Indicador16::select(
        DB::raw('json_build_object(yearmonth, json_agg(ROUND(monto_licitado,2))) as data'))
        ->groupBy('yearmonth')
        ->whereBetween('yearmonth', [$mindate, $maxdate])
        ->where('procedimiento', $procedimiento)
        ->get();
        $indicador16f=array();
        foreach ($indicador16 as $key => $value) {
            $value1 =  str_replace(array("{", "}", "\"", '"'), "", json_encode($value['data']));
             array_push($indicador16f ,$value1);
        }
        return $indicador16f;
        
    }
}
