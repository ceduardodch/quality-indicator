<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerIndicator1;
use App\Http\Controllers\ControllerIndicator2;
use App\Http\Controllers\ControllerIndicator3;
use App\Http\Controllers\ControllerIndicator4;
use App\Http\Controllers\ControllerIndicator5;
use App\Http\Controllers\ControllerIndicator6;
use App\Http\Controllers\ControllerIndicator7;
use App\Http\Controllers\ControllerIndicator8;
use App\Http\Controllers\ControllerIndicator9;
use App\Http\Controllers\ControllerIndicator10;
use App\Http\Controllers\ControllerIndicator11;
use App\Http\Controllers\ControllerIndicator12;
use App\Http\Controllers\ControllerIndicator13;
use App\Http\Controllers\ControllerIndicator14;
use App\Http\Controllers\ControllerIndicator15;
use App\Http\Controllers\ControllerIndicator16;
use App\Http\Controllers\ControllerIndicator17;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('indicador1', [ControllerIndicator1::class, 'index']);

//Route::get('indicador1download', [ControllerIndicator1::class, 'exportExcel']);

Route::get('indicador2', [ControllerIndicator2::class, 'index']);
Route::get('indicador3', [ControllerIndicator3::class, 'index']);
Route::get('indicador4', [ControllerIndicator4::class, 'index']);
Route::get('indicador5', [ControllerIndicator5::class, 'index']);
Route::get('indicador6', [ControllerIndicator6::class, 'index']);
Route::get('indicador7', [ControllerIndicator7::class, 'index']);
Route::get('indicador8', [ControllerIndicator8::class, 'index']);
Route::get('indicador9', [ControllerIndicator9::class, 'index']);
Route::get('indicador10', [ControllerIndicator10::class, 'index']);
Route::get('indicador11', [ControllerIndicator11::class, 'index']);
Route::get('indicador12', [ControllerIndicator12::class, 'index']);
Route::get('indicador13', [ControllerIndicator13::class, 'index']);
Route::get('indicador14', [ControllerIndicator14::class, 'index']);
Route::get('indicador15', [ControllerIndicator15::class, 'index']);
Route::get('indicador16', [ControllerIndicator16::class, 'index']);
Route::get('indicador17', [ControllerIndicator17::class, 'index']);
Route::get('indicador1/export/', [ControllerIndicator1::class, 'export']);

//Route::get('download', [FrontController::class, 'get_download']);



