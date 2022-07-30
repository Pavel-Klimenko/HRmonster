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
Route::post('api/create-company', [Controller::class, 'CreateCompany'])->name('create-company');
Route::post('api/create-vacancy', [Controller::class, 'createVacancy'])->name('create-vacancy');
Route::post('api/respond-to-vacancy', [Controller::class, 'respondToVacancy'])->name('respond-to-vacancy');

Route::get('api/show-vacancies/{companyId}', [Controller::class, 'showCompanyVacancies'])->name('show-vacancies');
Route::get('api/show-companies', [Controller::class, 'showCompanies'])->name('show-companies');
Route::post('api/create-candidate-response', [Controller::class, 'createCandidateResponse'])->name('create-vacancy');


//Route::get('save-candidate-file/{candidateRespondId}', [Controller::class, 'saveCandidateFile'])->name('save-candidate-file');
