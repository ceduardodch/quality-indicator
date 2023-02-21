<?php

namespace App\Exports;

use App\Models\Indicador1;
use Maatwebsite\Excel\Concerns\FromCollection;

class Indicador1Export implements FromCollection
{
    public function collection()
    {
        return Indicador1::all();
    }
}