<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

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
 

Route::group(['middleware' => 'web'], function () {
    Route::get(env('LARAVUE_PATH'), 'LaravueController@index')->where('any', '.*')->name('laravue');
    Route::resource('patient', PatientController::class);
    Route::get('patient/delete/{id}', [App\Http\Controllers\PatientController::class, 'delete'])->name("delete");
    Route::resource('doctor',DoctorController::class);
    Route::get('doctor/delete/{id}', [App\Http\Controllers\DoctorController::class, 'delete'])->name("doctor.delete");
    Route::resource('appointment',AppointmentController::class);
    Route::get('appointment/delete/{id}', [App\Http\Controllers\AppointmentController::class, 'delete'])->name("appointment.delete");
});

//Auth::routes();
