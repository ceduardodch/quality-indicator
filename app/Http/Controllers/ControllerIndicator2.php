<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador2;

class ControllerIndicator2 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador2::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
