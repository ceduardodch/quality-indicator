<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador15;

class ControllerIndicator15 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador15::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
