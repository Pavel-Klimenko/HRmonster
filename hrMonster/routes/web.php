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

//HR routes

Route::get('create-vacancy', [Controller::class, 'createVacancy'])->name('create-vacancy');
Route::get('respond-to-vacancy', [Controller::class, 'respondToVacancy'])->name('respond-to-vacancy');





