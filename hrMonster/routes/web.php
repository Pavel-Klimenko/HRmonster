<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/test', function () {
    return view('test');
});



//HR routes
Route::get('create-company', [Controller::class, 'CreateCompany'])->name('create-company');
Route::get('create-vacancy', [Controller::class, 'createVacancy'])->name('create-vacancy');
Route::post('respond-to-vacancy', [Controller::class, 'respondToVacancy'])->name('respond-to-vacancy');
Route::get('get-vacancies/{companyName}', [Controller::class, 'getVacancies'])->name('get-vacancies');
Route::get('save-candidate-file/{candidateRespondId}', [Controller::class, 'saveCandidateFile'])->name('save-candidate-file');
