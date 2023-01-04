<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador14;

class ControllerIndicator14 extends Controller
{

    public function index()
    {
        $indicador1 = Indicador14::select("*")
        ->get()
        ->toArray();

        dd($indicador1);  
    }
}
