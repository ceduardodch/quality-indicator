<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador17;

class ControllerIndicator17 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador17::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
