<?php

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

use App\Http\Controllers\LoanDetailsController;

Route::get('/loan-details', [LoanDetailsController::class, 'index'])->name('loan-details.index');
Route::get('/process-data', [LoanDetailsController::class, 'processData'])->name('process-data.index');
Route::post('/process-data', [LoanDetailsController::class, 'processDataFunc'])->name('process.data');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
