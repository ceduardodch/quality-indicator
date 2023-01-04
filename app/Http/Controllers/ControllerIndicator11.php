<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador11;

class ControllerIndicator11 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador11::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
