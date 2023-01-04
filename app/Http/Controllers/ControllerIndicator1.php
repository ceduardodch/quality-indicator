<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador1;

class ControllerIndicator1 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador1::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
