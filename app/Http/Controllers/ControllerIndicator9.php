<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador9;

class ControllerIndicator9 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador9::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
