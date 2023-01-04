<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador6;

class ControllerIndicator6 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador6::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
