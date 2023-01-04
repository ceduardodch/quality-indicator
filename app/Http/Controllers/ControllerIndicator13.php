<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador13;

class ControllerIndicator13 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador13::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
