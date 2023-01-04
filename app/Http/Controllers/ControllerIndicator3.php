<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador3;

class ControllerIndicator3 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador3::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
