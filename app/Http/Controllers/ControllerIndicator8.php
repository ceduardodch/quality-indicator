<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador8;

class ControllerIndicator8 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador8::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
