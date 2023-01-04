<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador12;

class ControllerIndicator12 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador12::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
