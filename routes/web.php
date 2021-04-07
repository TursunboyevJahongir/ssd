<?php

use App\Http\Actions\AddCostAction;
use App\Http\Actions\AddIncomeAction;
use App\Http\Actions\GetCostsAction;
use App\Http\Actions\GetDistrictsFromRegionAction;
use App\Http\Actions\GetIncomesAction;
use App\Http\Actions\GetUsersAction;
use App\Http\Actions\GetUsersFromRegionAction;
use App\Http\Actions\PrisonerAction;
use App\Http\Actions\PrisonersAction;
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

//Route::group(['prefix' => 'first'], function () {
Route::get('incomes/{date?}', GetIncomesAction::class)->name('incomes');
Route::post('income', AddIncomeAction::class)->name('add.income');
Route::post('cost', AddCostAction::class)->name('add.cost');
Route::get('costs/{date?}', GetCostsAction::class)->name('costs');
Route::get('users/{region?}', GetUsersAction::class)->name('users.from.region');
Route::get('prisoners/{law?}', PrisonersAction::class)->name('prisoners');
Route::get('prisoner/{id}', PrisonerAction::class)->name('prisoner');
Route::get('user/{region?}/{district?}', GetUsersFromRegionAction::class);
//});
