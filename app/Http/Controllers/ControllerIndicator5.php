<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador5;

class ControllerIndicator5 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador5::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
