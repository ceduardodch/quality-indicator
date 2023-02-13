<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador17 extends Model
{
    protected $casts = [
        'data' => 'array',
    ];
    use HasFactory;
    public $table = "view_indicador17_data";

}
