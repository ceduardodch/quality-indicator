<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador7;

class ControllerIndicator7 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador7::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
