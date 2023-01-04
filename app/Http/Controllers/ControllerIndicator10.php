<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador10;

class ControllerIndicator10 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador10::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
