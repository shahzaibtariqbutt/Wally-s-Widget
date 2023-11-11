<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('widgetPack');
});

Route::post('/calculate-packs', [WidgetController::class, 'calculatePacks'])->name('calculatePacks');