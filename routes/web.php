<?php

use App\Http\Actions\First\GetCostsAction;
use App\Http\Actions\First\GetIncomesAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'first'], function () {
    Route::get('/incomes/{date?}', GetIncomesAction::class)->name('incomes');
    Route::get('/costs/{date?}', GetCostsAction::class)->name('costs');
});
