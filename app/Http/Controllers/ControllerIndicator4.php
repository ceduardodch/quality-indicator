<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador4;

class ControllerIndicator4 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador4::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
