<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador16;

class ControllerIndicator16 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador16::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
