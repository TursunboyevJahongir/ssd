<?php

use App\Http\Actions\First\AddCostAction;
use App\Http\Actions\First\AddIncomeAction;
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
})->name('home');

Route::group(['prefix' => 'first'], function () {
    Route::get('incomes/{date?}', GetIncomesAction::class)->name('incomes');
    Route::post('income', AddIncomeAction::class)->name('add.income');
    Route::post('cost', AddCostAction::class)->name('add.cost');
    Route::get('costs/{date?}', GetCostsAction::class)->name('costs');
});
