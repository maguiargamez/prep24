<?php

use App\Http\Controllers\API\Prep\AuthController;
use App\Http\Controllers\API\Prep\PollingPlaces\RecordsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('get/distritos', [RecordsController::class, 'getDistricts'])->name('polling-places.get-districts.list');
    Route::get('get/municipios', [RecordsController::class, 'getMunicipalities'])->name('polling-places.get-municipalities.list');
    Route::get('get/secciones', [RecordsController::class, 'getSections'])->name('polling-places.get-sections.list');

    Route::get('casillas/actas/pendientes', [RecordsController::class, 'withOutRecords'])->name('polling-places.without-records.list');    
    Route::get('casillas/actas/digitalizadas', [RecordsController::class, 'digitizedRecords'])->name('polling-places.digitized-records.list');
    //Route::get('casillas/actas/capturadas', [RecordsController::class, 'withOutRecords'])->name('polling-places.without-records.list');
    Route::get('casillas/detalle', [RecordsController::class, 'pollingPlaceDetail'])->name('polling-places.detail');

    Route::post('casillas/digitalizar', [RecordsController::class, 'saveDigitizedRecord'])->name('polling-places.save-digitized-record.list');



});