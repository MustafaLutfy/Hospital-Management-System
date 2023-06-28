<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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


Route::get('/',[HomeController::class,'index']);

Route::get('/home',[HomeController::class,'redirect'])->middleware(['auth','verified']);

Route::get('/add_doctor_view',[AdminController::class,'addview']);


Route::post('/upload_doctor',[AdminController::class,'upload']);
Route::get('/appointments',[AdminController::class,'appointments']);
Route::get('/approve_apt/{id}',[AdminController::class,'approve']);
Route::get('/decline_apt/{id}',[AdminController::class,'decline']);
Route::get('/edit_doctor/{id}',[AdminController::class,'edit']);
Route::get('/delete_doctor/{id}',[AdminController::class,'delete']);
Route::get('/doctors',[AdminController::class,'showdoctors']);
Route::post('/appointment',[HomeController::class,'appointment']);
Route::get('/myappointments',[HomeController::class,'myappointments']);
Route::get('/delete_apt/{id}',[HomeController::class,'deleteApt']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth','verified'])->name('dashboard');
});

